<?php
namespace App\Controller;
use App\Entity\Activiteit;
use App\Entity\Soortactiviteit;
use App\Form\Activiteit1Type;
use App\Repository\ActiviteitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activiteit")
 */
class ActiviteitController extends AbstractController
{
    /**
     * @Route("/", name="activiteit_index", methods={"GET"})
     */
    public function index(): Response
    {
        $repository=$this->getDoctrine()->getRepository(Soortactiviteit::class);
        $activiteitRepository=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();

        return $this->render('activiteit/index.html.twig', [
            'activiteits' => $activiteitRepository
        ]);
    }
    /**
     * @Route("/new", name="activiteit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $activiteit = new Activiteit();
        $form = $this->createForm(Activiteit1Type::class, $activiteit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activiteit);
            $entityManager->flush();
            return $this->redirectToRoute('activiteit_index');
        }
        return $this->render('activiteit/new.html.twig', [
            'activiteit' => $activiteit,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="activiteit_show", methods={"GET"})
     */
    public function show(Activiteit $activiteit): Response
    {
        return $this->render('activiteit/show.html.twig', [
            'activiteit' => $activiteit,
        ]);
    }
    /**
     * @Route("/{id}/edit", name="activiteit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Activiteit $activiteit): Response
    {
        $form = $this->createForm(Activiteit1Type::class, $activiteit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('activiteit_index');
        }
        return $this->render('activiteit/edit.html.twig', [
            'activiteit' => $activiteit,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="activiteit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Activiteit $activiteit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activiteit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activiteit);
            $entityManager->flush();
        }
        return $this->redirectToRoute('activiteit_index');
    }
}