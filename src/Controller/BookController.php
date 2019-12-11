<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;

class BookController extends AbstractController
{
    /**
     * @Route("/book-list", name="book-list")
     */
    public function index()
    {
        //Liste des livres
        //récupération du repository book pour faire des requetes sur Book
        $repository = $this->getDoctrine()->getRepository(Book::class);
        $bookList = $repository->findAll();

        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
            'bookList' => $bookList
        ]);
    }

    /**
     * @Route("/book/new")
     * @param Request $request
     * @return Response
     */
    public function createBook(Request $request){

        // Création du formulaire
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        //recupere les données postées et l'injecte dans le formulaire
        //l'objet associé donc book est aussi hydraté
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute("book-list");
        }

        return $this->render("book/new.html.twig", [
            "bookForm" => $form->createView()
        ]);
    }

    /**
     *
     * @Route("/book/delete/{id}", name="book-delete")
     * @param $id
     * @return RedirectResponse
     */
    public function deleteBook($id){

        $repository = $this->getDoctrine()->getRepository(Book::class);
        $book = $repository->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        if($book){
            $entityManager->remove($book);

            $entityManager->flush();
        }

        return $this->redirectToRoute("book-list");
    }
}
