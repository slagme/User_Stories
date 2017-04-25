<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Contact;
use MainBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends Controller
{
    /**
     * @Route("/new")
     * @Method("GET")
     * @Template("MainBundle:Contact:new.html.twig")
     */
    public function newFormulaAction()
    {
        $contact = new Contact ();

        $form = $this->createForm(ContactType::class, $contact,
            ['action' => $this->generateUrl('main_contact_new')]);

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/new")
     * @Method("POST")
     * @Template("MainBundle:Contact:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('main_contact_new', ['id' => $contact->getId()]);
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/{id}/modify")
     * @Method("GET")
     */
    public function modifyFormulaAction()
    {
        return $this->render('MainBundle:Default:index.html.twig');
    }

    /**
     * @Route("/{id}/modify")
     * @Method("POST")
     * @Template("MainBundle:Contact:new.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $contact = $this
            ->getDoctrine()
            ->getRepository('MainBundle:Contact')
            ->find($id);

        if (!$contact){
            throw $this->createNotFoundException('Contact not found');
        }

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->flush();

            return $this->redirectToRoute('main_contact_show', ['id' => $contact->getId()]);
        }

        return ['form' => $form->createView()];
    }
    /**
     * @Route("/{id}/delete")
     * @Method("GET")
     */
    public function deleteFormAction()
    {
        return $this->render('MainBundle:Default:index.html.twig');
    }

    /**
     * @Route("/{id}")
     * @Method("GET")
     */
    public function showContactAction()
    {
        return $this->render('MainBundle:Default:index.html.twig');
    }

    /**
     * @Route("/")
     * @Method("GET")
     */
    public function showAllAction()
    {
        return $this->render('MainBundle:Default:index.html.twig');
    }


}