<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use App\Form\Admin\ImportCustomerType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormError;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;

class CustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        // this action executes the 'renderInvoice()' method of the current CRUD controller
        $importFromCSV = Action::new('importFromCSV', 'Import depuis csv', 'fa fa-file-import')
            ->createAsGlobalAction()
            ->linkToCrudAction('importFromCSV');
        ;

        return $actions
            ->add(Crud::PAGE_INDEX, $importFromCSV)
        ;
    }

    public function importFromCSV(
        Request $request,
        AdminContext $context
    ): Response
    {
        $form = $this->createForm(ImportCustomerType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->addError(
                new FormError("Erreur en important la ligne 42")
            );
        }

        return $this->render(
            'import_from_csv.html.twig',
            [
                'ea' => $context,
                'form' => $form->createView(),
            ]
        );

    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
