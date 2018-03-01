<?php
namespace App\Presenters;

use App\Forms\EditPersonFactory;
use App\Forms\DeletePersonFactory;
use Nette;
use App\Model;

class PersonsPresenter extends Nette\Application\UI\Presenter
{

    /** @var Model\PersonsManager @inject */
    public $personsManager;

    /** @var EditPersonFactory @inject */
    public $editPersonForm;

    /** @var DeletePersonFactory @inject */
    public $deletePersonForm;

    private $isAjax = false;

    private $search = '';

    const ON_PAGE = 10;

    public function renderEdit($id = 0,$page = 0)
    {
        $form = $this['editPersonForm'];
        if (!$form->isSubmitted()) {
            $person = $this->personsManager->findById($id);
            if (!$person) {
                $this->error('Record not found');
            }
            $date = Model\PersonsManager::dateConvertFrom($person[Model\PersonsManager::ROW_WORK_START_DT],true);
            $form->setDefaults($person);
            $form[Model\PersonsManager::ROW_WORK_START_DT]->setDefaultValue($date);
            $this->template->person = $person;
            $this->template->page = $page;
            //$this->flashMessage('id = '.$person[Model\PersonsManager::ROW_WORK_START_DT]);
        }
    }
    protected function createComponentEditPersonForm()
    {
        return $this->editPersonForm->create();
    }

    public function renderDelete($id=0,$page=0){
        $form = $this['deletePersonForm'];
        if (!$form->isSubmitted()) {
            $person = $this->personsManager->findById($id);
            if (!$person) {
                //$this->error('Record not found');
                $this->flashMessage('Record not found');
            }else{

                $result = $this->personsManager->deleteById($id);
            }

            $this->redirect('default',['page' => $page]);
        }
    }
    protected function createComponentDeletePersonForm()
    {
        return $this->deletePersonForm->create();
    }


    public function renderDefault(int $page = 1,$search = ''){

        if ($this->isAjax == false){
            $this->isAjax = '';
            $this->search = $search;
            $paginator = self::initPaginator($page,$search);
            $staffs = $this->personsManager->findPublishedStaff($paginator->getLength(), $paginator->getOffset(),$search);
            $this->template->staffs = $staffs;
            $this->template->search = $this->search;
            $this->template->paginator = $paginator;
        }
    }

    public function handleUpdate(int $page = 1,$search = '')
    {
        if ($this->isAjax() and !$this->isAjax){
            //$this->error('Record not found');
            $this->isAjax = true;
            // количество записей
            $this->search = $search;
            $paginator = self::initPaginator($page,$search);
            $staffs = $this->personsManager->findPublishedStaff($paginator->getLength(), $paginator->getOffset(),$search);
            $this->template->staffs = $staffs;
            $this->template->paginator = $paginator;
            $this->template->search = $this->search;
            $this->redrawControl('itemsContainer');
        }

    }

    public function handleSearch($search='')
    {

        //$this->error('Record not found '.$search);
        if ($this->isAjax() and !$this->isAjax) {
            $this->isAjax = true;
            $this->search = $search;
            $paginator = self::initPaginator(1,$search);
            $staffs = $this->personsManager->findPublishedStaff($paginator->getLength(), $paginator->getOffset(),$search);
            $this->template->staffs = $this->personsManager->findLikeAll($search);
            $this->template->paginator = $paginator;
            $this->template->search = $this->search;
            $this->redrawControl('itemsContainer');
        }
    }

    private function initPaginator($page,$search){
        $staffsCount = $this->personsManager->getPublishedStaffsCount($search);
        $paginator = new Nette\Utils\Paginator;
        $paginator->setItemCount($staffsCount); // count
        $paginator->setItemsPerPage(self::ON_PAGE); // items per page
        $paginator->setPage($page); // actual page number
        return $paginator;
    }

    public function renderAdd(){
        $form = $this['editPersonForm'];
        if (!$form->isSubmitted()) {

        }
    }





}