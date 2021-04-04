<?php

namespace App\Controller;

use App\Entity\Empresas;
use App\Entity\Sectores;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Column\TwigColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;

class EmpresasController extends AbstractController {

    #[Route('/empresas', name: 'empresas')]
    public function index(): Response {
        return $this->render('empresas/index.html.twig', [
                    'controller_name' => 'EmpresasController',
        ]);
    }

    /**
     * Devuelve un sector por id
     */
    public function getSector(int $id) {
        $sector = $this->getDoctrine()
                ->getRepository(Sectores::class)
                ->find($id);
        if (!$sector) {
            throw $this->createNotFoundException(
                            'No existe el sector con id: ' . $id
            );
        }

        return $sector;
    }

    /**
     * Devuelve una empresa por id
     */
    public function getEmpresa(int $id) {
        $empresa = $this->getDoctrine()
                ->getRepository(Empresas::class)
                ->find($id);
        if (!$empresa) {
            throw $this->createNotFoundException(
                            'No existe la empresa con id: ' . $id
            );
        }

        return $empresa;
    }

    /**
     * Genera el formulario para crear una nueva empresa
     * @Route("/empresa/new", name="form_new_empresa")
     */
    public function formNewEmpresa(Request $request): Response {

        $empresa = new Empresas();

        
        $form = $this->createFormBuilder($empresa)
                ->add('nombre', TextType::class)
                ->add('telefono', TextType::class)
                ->add('email', TextType::class)
                ->add('sector', EntityType::class, [
                    'class' => 'App\Entity\Sectores',
                    'choice_label' => 'nombre',
                ])
                ->add('save', SubmitType::class, ['label' => 'Guardar'])
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $empresa = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($empresa);
            $entityManager->flush();
            return $this->redirectToRoute('empresa_showAll');
        }

        // $form = $this->createForm(TaskType::class, $empresa);


        return $this->render('empresas/create.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    /**
     * Genera el formulario para editar una empresa
     * @Route("/empresa/edit/{id}", name="form_edit_empresa")
     */
    public function formEditEmpresa(Request $request, int $id): Response {

        $empresa = $this->getEmpresa($id);
        $form = $this->createFormBuilder($empresa)
                ->add('nombre', TextType::class)
                ->add('telefono', TextType::class)
                ->add('email', TextType::class)
                ->add('sector', EntityType::class, [
                    'class' => 'App\Entity\Sectores',
                    'choice_label' => 'nombre',
                ])
                ->add('save', SubmitType::class, ['label' => 'Guardar'])
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $empresa = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($empresa);
            $entityManager->flush();

            return $this->redirectToRoute('empresa_showAll');
        }

        return $this->render('empresas/create.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    /**
     * Genera una pagina de confirmacion para borrar una empresa
     * @Route("/empresa/eliminarConfirmacion/{id}", name="deleteConfirm_empresa")
     */
    public function deleteConfirmEmpresa(Request $request, int $id): Response {
        return $this->render('empresas/delete.html.twig', [
                    'id' => $id,
        ]);
    }

    /**
     * GBorra una empresa
     * @Route("/empresa/eliminar/{id}", name="delete_empresa")
     */
    public function deleteEmpresa(Request $request, int $id): Response {

        $empresa = $this->getEmpresa($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($empresa);
        $entityManager->flush();

        return $this->redirectToRoute('empresa_showAll');
    }

    /**
     * Devuelve todos los  empresas
     * @Route("/empresa/all", name="empresa_showAll")
     */
    public function showAll(Request $request, DataTableFactory $dataTableFactory) {
        
        $table = $dataTableFactory->create()
                ->add('id', TextColumn::class, ['label' => 'Id', 'visible' => false])
                ->add('nombre', TextColumn::class, ['label' => 'Nombre', 'globalSearchable' => true])
                ->add('email', TextColumn::class, ['label' => 'Email', 'globalSearchable' => true])
                ->add('telefono', TextColumn::class, ['label' => 'Telefono', 'globalSearchable' => true])
                ->add('sectores', TextColumn::class, ['label' => 'Sector', 'field' => 'sector.nombre', 'globalSearchable' => true])
                ->add('acciones', TwigColumn::class, [
                    'label' => 'Acciones',
                    'className' => 'buttons',
                    'template' => 'empresas/buttonbar.html.twig',
                ])
                ->createAdapter(ORMAdapter::class, [
                    'entity' => Empresas::class,
                ])
                ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        return $this->render('empresas/datos.html.twig', ['datatable' => $table]);
    }

}
