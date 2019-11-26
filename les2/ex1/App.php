<?php

class App {
    private $count = 1000000;
    /**
     * Основная функция приложения - все исполнение кода приложения
     */
    public function run() {
        $this->ex1FromAlgorighmPhp();
        echo 'Hello';
    }

    private function ex1FromAlgorighmPhp() {
        for ($i = 0; $i < $this->count; ++$i) {
            $arr[] = $i;
        }

        $obj = new ArrayObject($arr);
        $iter = $obj->getIterator();

        foreach ($arr as $key => $value) {
            $key.'='.$value."\n";
        }

        $startIterator = microtime(true);
        while ($iter->valid()) {
            $iter->key().'='.$iter->current()."\n";
            $iter->next();
        }
    }
}