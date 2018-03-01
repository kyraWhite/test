<?php

namespace App\Presenters;


class HomepagePresenter extends BasePresenter
{
	public function renderDefault()
    {
        $this->flashMessage('Вы были переадресованны на список сотрудников');
		$this->redirect("Persons:");
	}
}
