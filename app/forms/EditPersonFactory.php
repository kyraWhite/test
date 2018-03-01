<?php
/**
 * Created by PhpStorm.
 * User: KOT
 * Date: 26.02.2018
 * Time: 22:46
 */

namespace App\Forms;


use App\Model\PersonsManager;
use Nette\Forms\Form;
use App\Model;
use Nette\Application\BadRequestException;


class EditPersonFactory
{
    /** @var FormFactory */
    private $factory;

    /** @var Model\PersonsManager @inject */
    private $personsManager;

    private $id;
    private $name;

    public function __construct(FormFactory $factory,PersonsManager $personsManager)
    {
        $this->factory = $factory;
        $this->personsManager = $personsManager;
    }

    public function create(){
        $form = $this->factory->create();

        $form->addHidden(Model\PersonsManager::ROW_ID,0);
        $form->addText(Model\PersonsManager::ROW_NAME, "ФИО");
        $form->addText(Model\PersonsManager::ROW_POSITION, "Должность");
        $form->addText(Model\PersonsManager::ROW_WORK_START_DT, "Дата начала работы")
            ->setAttribute('id','datepicker')
            ->setAttribute('class','datepicker')
            ->addRule(Form::PATTERN, "Неверный формат даты", Model\PersonsManager::REGEX_DATE)
            ->setRequired('Укажите дату');
        $form->addCheckbox(Model\PersonsManager::ROW_STATUS, "Работает");

        $form->addSubmit("save","Сохранить");

        $form->addProtection();

        $form->onSuccess[] = array($this, 'formSucceeded');
        return $form;
    }

    public function formSucceeded(Form $form,$values){
        $presenter = $form->getPresenter();

        //$values->work_stat_dt = \DateTime::createFromFormat('d.m.Y', $values->work_stat_dt)->format('Y-m-d');
        $values->work_start_dt = PersonsManager::dateConvertFrom($values->work_start_dt,false);

        $this->personsManager->updatePerson(
            $values->id,
            $values->name,
            $values->position,
            $values->work_start_dt,
            $values->status
        );
        if ($values->id){
            $presenter->flashMessage('Данные пользователя успешно обновлены.', 'success');
        }else{
            $presenter->flashMessage('Данные о пользователе успешно добавленны.', 'success');
        }

        $presenter->redirect('Persons:');

    }
}