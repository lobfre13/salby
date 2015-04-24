<?php

    class ChosenTasks{

        private $classid;
        private $taskList;

        public function __construct($classid){
            $this->setClassid($classid);
            $this->taskList = [];
        }

        public function getClassid(){
            return $this->classid;
        }

        public function setClassid($classid){
            $this->classid = $classid;
        }

        public function getTaskList(){
            return $this->taskList;
        }

        public function addTask($task){
            $this->taskList []= $task;
        }

    }