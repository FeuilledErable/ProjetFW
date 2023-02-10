<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Entity\Note;
use App\Form\AtelierType;
use App\Form\NoteType;
use App\MesServices\MarkdownAtelier;
use App\Repository\AtelierRepository;
use App\Repository\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/atelier')]
class AtelierController extends AbstractController
{
    #[Route('/', name: 'app_atelier_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('atelier/index.html.twig');
    }

    #[Route('/liste', name: 'app_atelier_list', methods: ['GET'])]
    public function list(AtelierRepository $atelierRepository, MarkdownAtelier $markdownAtelier): Response
    {
        $ateliers =  $markdownAtelier->parseArray($atelierRepository->findAll());
        return $this->render('atelier/list.html.twig', [
            'ateliers' => $ateliers,
        ]);
    }

    #[Route('/new', name: 'app_atelier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AtelierRepository $atelierRepository): Response
    {
        $atelier = new Atelier();
        $form = $this->createForm(AtelierType::class, $atelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $atelier->setInstructeur($this->getUser());
            $atelierRepository->save($atelier, true);

            return $this->redirectToRoute('app_atelier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('atelier/new.html.twig', [
            'atelier' => $atelier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_atelier_show', methods: ['GET'])]
    public function show(Atelier $atelier, MarkdownAtelier $markdownAtelier): Response
    {

        $notes = $atelier->getNotes();
        if (count($notes) !== 0) {
            $som = 0;
            foreach ($notes as $note) {
                $som = $som + $note->getValeur();
            }
            $moyenne = $som / count($notes) ;
        }
        else {
            $moyenne = -1;
        }


        return $this->render('atelier/show.html.twig', [
            'atelier' => $markdownAtelier->parse($atelier),
            'moyenne' => $moyenne,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_atelier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Atelier $atelier, AtelierRepository $atelierRepository): Response
    {
        $form = $this->createForm(AtelierType::class, $atelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $atelierRepository->save($atelier, true);

            return $this->redirectToRoute('app_atelier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('atelier/edit.html.twig', [
            'atelier' => $atelier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_atelier_delete', methods: ['POST'])]
    public function delete(Request $request, Atelier $atelier, AtelierRepository $atelierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$atelier->getId(), $request->request->get('_token'))) {
            $atelierRepository->remove($atelier, true);
        }

        return $this->redirectToRoute('app_atelier_list', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/inscription/{id}', name:'app_atelier_inscription', methods: ['POST', 'GET'])]
    public function inscription(Atelier $atelier, AtelierRepository $atelierRepository):Response
    {
        $atelierModifier = $atelier->addApprenti($this->getUser());
        $atelierRepository->save($atelierModifier, true);

        return $this->redirectToRoute('app_atelier_show', ['id' => $atelier->getId()]);
    }

    #[Route('/desinscription/{id}', name: 'app_atelier_desinscription', methods: ['POST', 'GET'])]
    public function descinscription(Atelier $atelier, AtelierRepository $atelierRepository) {
        $atelierModifier = $atelier->removeApprenti($this->getUser());
        $atelierRepository->save($atelierModifier, true);

        return $this->redirectToRoute('app_atelier_show', ['id' => $atelier->getId()]);
    }

    #[Route('/noter/{id}', name: 'app_note_noter', methods: ['GET', 'POST'])]
    public function noter(Atelier $atelier, Request $request, NoteRepository $noteRepository): Response
    {
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $notes = $noteRepository->findAll();
            foreach ($notes as $n) {
                if (($n->getAtelier() == $atelier) and ($n->getApprenti() == $this->getUser())) {
                    return $this->redirectToRoute('app_atelier_show', ['id' => $atelier->getId()]);
                }
            }

            $atelier->addNote($note);
            $this->getUser()->addNote($note);
            $noteRepository->save($note, true);

            return $this->redirectToRoute('app_atelier_show', ['id' => $atelier->getId()]);
        }

        return $this->renderForm('layers/noter_atelier.html.twig', [
            'note' => $note,
            'form' => $form,
        ]);
    }

}
