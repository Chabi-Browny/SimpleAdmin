<?php

namespace App\Controller;

use App\Controller\Prototype\BasicController;
use App\Dto\ContactDto;
use App\Entity\Contact;
use App\Repository\ContactRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
//use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

use Symfony\Component\Serializer\SerializerInterface;

/**
 * Description of ContactController
 */
class ContactController extends BasicController
{
    /**/
    public function init()
    {
        $this->setPageTitle('Kapcsolat');
    }

    /**/
    #[Route('/contact', name:'contact')]
    public function contactForm()
    {
        return $this->render('contact/index.html.twig');
    }

    /**/
    #[Route('/submitContact', name:'submit_contact', methods: ["POST"] )]
    public function submitForm(
        Request $request,
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        ContactRepository $contactRepo
    ): Response
    {
        $name = $request->getPayload()->get('uname');
        $email = $request->getPayload()->get('email');
        $question = $request->getPayload()->get('question');

        $errorObj = $validator->validate( new ContactDto( $name, $email, $question ) );

        $errors = json_decode( $serializer->serialize($errorObj, 'json'), true);

        if (count($errors['violations']) > 0)
        {
            $this->addFlash('errors', $errors['violations']);
        }
        else
        {
            $contactEntity = new Contact();
            $contactEntity->setName($name);
            $contactEntity->setEmail($email);
            $contactEntity->setQuestion($question);

            $contactRepo->save( $contactEntity );

            $this->addFlash('success', 'Köszönjük szépen a kérdésedet. Válaszunkkal hamarosan keresünk a megadott e-mail címen.');
        }

        return $this->redirectToRoute('contact');
    }

}
