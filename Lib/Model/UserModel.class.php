<?php

class UserModel extends RelationModel {

    protected $_link = array(
        'Role' => array(
            'mapping_type' => BELONGS_TO,
            'class_name' => 'Role',
            'foreign_key' => 'roleid',
            'mapping_fields' => 'author'
        )
    );

}
