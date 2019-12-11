<?php


namespace App\Controller;


use App\Entity\Publisher;
use App\Form\PublisherType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublisherController extends AbstractController
{
    /**
     * @Route("/publishers", name="publishers")
     * @return Response
     */
    public function index()
    {
        //Liste des éditeurs
        //récupération du repository publisher pour faire des requetes sur Publisher
        $repository = $this->getDoctrine()->getRepository(Publisher::class);
        $publisherList = $repository->findAll();

        return $this->render('publisher/index.html.twig', [
            'controller_name' => 'PublisherController',
            'publisherList' => $publisherList
        ]);
    }

    /**
     * @Route("/publisher/new")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createPublisher(Request $request){

        // Création du formulaire
        $publisher = new Publisher();
        $form = $this->createForm(PublisherType::class, $publisher);

        //recupere les données postées et l'injecte dans le formulaire
        //l'objet associé donc book est aussi hydraté
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($publisher);
            $em->flush();

            return $this->redirectToRoute("publishers");
        }

        return $this->render("publisher/new.html.twig", [
            "publisherForm" => $form->createView()
        ]);
    }

    /**
     *
     * @Route("/publisher/delete/{id}", name="publisher-delete")
     * @param $id
     * @return RedirectResponse
     */
    public function deletePublisher($id){

        $repository = $this->getDoctrine()->getRepository(Publisher::class);
        $publisher = $repository->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        if($publisher){
            $entityManager->remove($publisher);

            $entityManager->flush();
        }

        return $this->redirectToRoute("publishers");
    }
}