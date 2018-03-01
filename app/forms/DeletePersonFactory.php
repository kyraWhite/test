<?php
/**
 * Created by PhpStorm.
 * User: KOT
 * Date: 28.02.2018
 * Time: 18:48
 */

namespace App\Forms;

use App\Model\PersonsManager;
use Nette\Forms\Form;
use App\Model;

class DeletePersonFactory
{
    /** @var FormFactory */
    private $factory;

    /** @var Model\PersonsManager @inject */
    private $personsManager;

    public function __construct(FormFactory $factory,PersonsManager $personsManager)
    {
        $this->factory = $factory;
        $this->personsManager = $personsManager;
    }

    public function create(){
        $form = $this->factory->create();

        /**$form->addDatePicker('date', "Date")
            ->setClassName('myBetterClass')//'bootstrapDatePicker' defalt
            ->setAutoclose(true)//true default
            ->setTodayHighlight()//or setTodadyHighlight(true); false default
            ->setWeekStart(1)//0 for Sunday, 6 for Saturday; 1 is default
            ->setKeyboardNavigation()//or setKyeboardnavigation(true); true default
            ->setTodayButton(\BeWeb\Components\Nette\BootstrapDatePicker::TODAY_BUTTON_TRUE)//TODAY_BUTTON_FALSE | TODAY_BUTTON_TRUE | TODAY_BUTTON_LINKED; TODAY_BUTTON_FALSE default
            ->setStartview(\BeWeb\Components\Nette\BootstrapDatePicker::STARTVIEW_MONTH)//STARTVIEW_MONTH | STARTVIEW_YEAR | STARTVIEW_DECADE; STARTVIEW_MONTH default
            ->setRequired()
            ->setInputButtonStyle(\BeWeb\Components\Nette\BootstrapDatePicker::BUTTON_STYLE_ICON_RIGHT)//BUTTON_STYLE_ICON_LEFT | BUTTON_STYLE_ICON_RIGHT | BUTTON_STYLE_ICON_NONE; BUTTON_STYLE_ICON_RIGHT default
            ->addCondition(Nette\Forms\Form::FILLED)
            ->addRule(
                \BeWeb\Components\Nette\BootstrapDatePicker::DATE_RANGE,
                'Entered date is not within allowed range.',
                array(new DateTime('2012-10-02'),	null));
*/

        return $form;
    }

}