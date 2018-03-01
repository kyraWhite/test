<?php
/**
 * Created by PhpStorm.
 * User: KOT
 * Date: 26.02.2018
 * Time: 16:14
 */

namespace App\Model;

use Nette;

class PersonsManager extends \Nette\Object
{
    const
        TABLE_NAME = 'person',
        REGEX_DATE = '^(\d)?\d\.(\d)?\d\.\d\d\d\d$',
        ROW_ID = 'id',
        ROW_NAME = 'name',
        ROW_POSITION = 'position',
        ROW_WORK_START_DT = 'work_start_dt',
        ROW_STATUS = 'status',
        ON_PAGE = 2;

    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    /** @return Nette\Database\Table\Selection */
    public function findAll($page = 0){
        return $this->database->table(self::TABLE_NAME)
            ->limit(self::ON_PAGE,self::ON_PAGE*$page);
    }

    public function findLikeAll($search = ''){
        return $this->database->table(self::TABLE_NAME)
            ->where('name LIKE ?', '%'.$search.'%')
            ;
    }

    /** @return Nette\Database\Table\ActiveRow */
    public function findById($id = 0){
        return $this->database->table(self::TABLE_NAME)->get($id);
    }

    public function updatePerson($id,$name,$position,$work_start_dt,$status){
        $personalData = array(
            self::ROW_NAME => $name,
            self::ROW_POSITION => $position,
            self::ROW_WORK_START_DT => $work_start_dt,
            self::ROW_STATUS => $status,
            );

        if ($id){
            $this->update($id, $personalData);
        }else{
            $this->insert($personalData);
        }
    }

    public function deleteById($id = 0){
        return $this->database->table(self::TABLE_NAME)
            ->where('id', $id)->delete();
    }

    private function update($id,$data){
        $this->database->table(self::TABLE_NAME)
            ->where('id', array($id))
            ->update($data);
    }

    private function insert($data){
        $this->database->table(self::TABLE_NAME)
            ->insert($data);
    }

    public static function dateConvertFrom($date,$show){

        if ($show){
            return \DateTime::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y');
        }else{
            return \DateTime::createFromFormat('d.m.Y', $date)->format('Y-m-d');
        }

    }

    public function findPublishedStaff(int $limit, int $offset, $search = ''): \Nette\Database\Table\Selection
    {
        return $this->database->table(self::TABLE_NAME)
            ->where('name LIKE ?', '%'.$search.'%')
            ->limit($limit,$offset);
    }

    public function getPublishedStaffsCount($search = ''): int
    {
        if ($search == ''){
            return $this->database->fetchField('SELECT COUNT(*) FROM person');
        }else{
            return $this->database->fetchField('SELECT COUNT(*) FROM person WHERE name LIKE "%'.$search.'%"');
        }

    }

}