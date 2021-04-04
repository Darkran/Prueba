<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Column\TwigColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController {

    #[Route('/user', name: 'user')]
    public function index(): Response {
        return $this->render('user/index.html.twig', [
                    'controller_name' => 'UserController',
        ]);
    }


    /**
     * Genera el formulario para crear un nuevo usuario
     * @Route("/user/new", name="form_new_user")
     */
    public function formNewUser(Request $request, UserPasswordEncoderInterface $encoder): Response {

        $user = new User();

        $form = $this->createFormBuilder($user)
                ->add('email', TextType::class)
                ->add('password', PasswordType::class)
                ->add('roles', ChoiceType::class, [
                    'label' => 'Roles',
                    'expanded' => false,
                    'multiple' => true,
                    'choices' => [
                        'Admin' => 'ROLE_ADMIN',
                        'User' => 'ROLE_USER',
                    ],
                ])
                ->add('save', SubmitType::class, ['label' => 'Guardar'])
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $plainPassword = $user->getPassword();
            $encoded = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encoded);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_showAll');
        }


        return $this->render('user/create.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    /**
     * Genera el formulario para editar un Usuario
     * @Route("/user/edit/{id}", name="form_edit_user")
     */
    public function formEditUser(Request $request, int $id, UserPasswordEncoderInterface $encoder): Response {

        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $id]);
        $form = $this->createFormBuilder($user)
                ->add('email', TextType::class)
                ->add('password', PasswordType::class)
                ->add('roles', ChoiceType::class, [
                    'label' => 'Roles',
                    'expanded' => false,
                    'multiple' => true,
                    'choices' => [
                        'Admin' => 'ROLE_ADMIN',
                        'User' => 'ROLE_USER',
                    ],
                ])
                ->add('save', SubmitType::class, ['label' => 'Guardar'])
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $plainPassword = $user->getPassword();
            $encoded = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encoded);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);

            $entityManager->flush();
            return $this->redirectToRoute('user_showAll');
        }

        return $this->render('user/edit.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    /**
     * Genera una pagina de confirmacion para borrar unç Usuario
     * @Route("/user/eliminarConfirmacion/{id}", name="deleteConfirm_user")
     */
    public function deleteConfirmUser(int $id): Response {
        return $this->render('user/delete.html.twig', [
                    'id' => $id,
        ]);
    }

    /**
     * GBorra un usuaro
     * @Route("/user/eliminar/{id}", name="delete_user")
     */
    public function deleteUser(int $id): Response {
        
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $id]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('user_showAll');
    }

    /**
     * Devuelve todos los  Usuarios
     * @Route("/user/all", name="user_showAll")
     */
    public function showAll(Request $request, DataTableFactory $dataTableFactory) {

        $table = $dataTableFactory->create()
                ->add('email', TextColumn::class, ['label' => 'Email'])
                ->add('roles', TextColumn::class, ['label' => 'Roles',
                    'data' => function ($context, $value) {
                        return implode(', ', $value);
                    }
                ])
                ->createAdapter(ORMAdapter::class, [
                    'entity' => User::class,
                ])
                ->add('acciones', TwigColumn::class, [
                    'label' => 'Acciones',
                    'className' => 'buttons',
                    'template' => 'user/buttonbar.html.twig',
                ])
                ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        return $this->render('user/datos.html.twig', ['datatable' => $table]);
    }

}
