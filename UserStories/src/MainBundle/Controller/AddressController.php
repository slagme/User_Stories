<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Address;
use MainBundle\Entity\Contact;
use MainBundle\Form\AddressType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\BrowserKit\Response;

class AddressController extends Controller
{

     /**
     * @Route("/{id}/addAddress")
     * @Method ("POST")
     */
    public function addAddressAction(Request $request,  $id)
    {
        $em=$this->getDoctrine()->getManager();
        $contact=$em->getRepository('MainBundle:Contact')->find($id);


        if (!$contact){
            throw $this->createNotFoundException('Contact not found');
        }

        $address= new Address();

        $formAddress = $this->createForm(AddressType::class, $address);
        $formAddress->handleRequest($request);

        if ($formAddress->isSubmitted() && $formAddress->isValid()) {
            $address->setContact($contact);
            $contact->addAddress($address);

            $em->persist($address);
            $em->flush();
        }
            return $this->redirectToRoute('main_contact_show', ['id' => $id]);

    }

    /**
     * @Route("/{id}/deleteAddress/")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $contact = $em->getRepository('MainBundle:Contact')->find($id);

        if (!$contact) {
            throw $this->createNotFoundException('Contact not found');
        }

        $address = $em->getRepository('MainBundle:Address')
            ->find($request->request->get('address_id'));
        if(!$address) {
            throw $this->createNotFoundException('Address not found');
        }

        $em->remove($address);
        $contact->removeAddress($address);

        $em->flush();

        return $this->redirectToRoute('main_contact_show', ['id' => $id]);

    }
 }

