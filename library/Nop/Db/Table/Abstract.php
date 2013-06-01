<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Nop_Db_Table_Abstract extends Zend_Db_Table_Abstract {

    public function getItems($id) {
        $select = $this->_db->select()
                ->from($this->_name)
                ->where('id = ?', $id)
                ->limit(1)
        ;
        $rowSet = $this->_db->fetchRow($select);
        if ($rowSet)
            return $rowSet;
        return false;
    }

    public function totalPaginator() {
        $select = $this->_db->select()
                ->from($this->_name, 'count(id) as total')
        ;
        $rowSet = $this->_db->fetchOne($select);
        return $rowSet;
    }

    public function listPaginator($arrParam = null) {
        $paginator = $arrParam['paginator'];
        if ($paginator['itemCountPerPage'] > 0) {
            $page = $paginator['currentPage'];
            $rowCount = $paginator['itemCountPerPage'];
        }
        $select = $this->_db->select()
                ->from($this->_name)
                ->limitPage($page, $rowCount)
        ;
        $rowSet = $this->_db->fetchAll($select);
        if ($rowSet)
            return $rowSet;
        return FALSE;
    }

}
