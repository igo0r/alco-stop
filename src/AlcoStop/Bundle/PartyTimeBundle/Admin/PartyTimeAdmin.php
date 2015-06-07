<?php

namespace AlcoStop\Bundle\PartyTimeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Symfony\Component\Security\Core\Security;

class PartyTimeAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add(
                'drinkId',
                'sonata_type_model',
                [
                    'class'        => 'DrinkBundle:Drink',
                    'multiple'     => false,
                    'by_reference' => false,
                    'label'        => 'Drinks',
                    'btn_add'      => false
                ]
            )
            ->add(
                'userId',
                'sonata_type_model',
                [
                    'class'   => 'AlcoStop\Bundle\UserBundle\Entity\User',
                    'btn_add' => false,
                    'label'   => 'User name'
                ]
            )
            ->add('volume', null, ['required' => true])
            ->add(
                'issueDate',
                'sonata_type_date_picker',
                [
                    'datepicker_use_button' => false,
                    'required'              => true,
                    'dp_use_current'        => true,
                    'format'                => 'dd-MM-yyyy',
                    'dp_show_today'         => true
                ]
            );
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('drinkId')
            ->add('userId');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('userId', null, ['label' => 'User names'])
            ->add('drinkId', null, ['label' => 'Drinks'])
            ->add('volume', null, ['label' => 'Volume (Liters)'])
            ->add('issueDate', null, ['label' => 'Party date', 'format' => 'd-M-y',])
            ->add(
                '_action',
                'input',
                [
                    'actions' => [
                        'show'   => [],
                        'edit'   => [],
                        'delete' => [],
                    ]
                ]
            );
    }
    /*
        public function createQuery($context = 'list')
        {
            $queryBuilder = $this->getModelManager()->getEntityManager($this->getClass())->createQueryBuilder();

            //if is logged admin, show all data
            if ($this->securityContext->isGranted('ROLE_ADMIN')) {
                $queryBuilder->select('p')
                    ->from($this->getClass(), 'p');
            } else {
                //for other users, show only data, which belongs to them
                $adminId = $this->securityContext->getToken()->getUser()->getAdminId();

                $queryBuilder->select('p')
                    ->from($this->getClass(), 'p')
                    ->where('p.adminId=:adminId')
                    ->setParameter('adminId', $adminId, Type::INTEGER);
            }

            $proxyQuery = new ProxyQuery($queryBuilder);

            return $proxyQuery;
        }*/

    /**
     * Security Context
     * @var Security
     */
    protected $securityContext;

    public function setSecurityContext(Security $securityContext)
    {
        $this->securityContext = $securityContext;
    }
}
