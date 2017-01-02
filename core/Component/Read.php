<?php
declare(strict_types = 1);

namespace Wumvi\Component;

/**
 * Базовый класс моделей
 */
abstract class Read
{
    /** Навание поля */
    const ARRAY_FIELD_NAME = 1;

    /** Тип поля */
    const ARRAY_TYPE_NAME = 2;

    /** Тип поля это уникальный ключ */
    const ARRAY_KEY_PK = 3;

    /** Тип Integer */
    const TYPE_INT = 1;

    /** Тип Float */
    const TYPE_FLOAT = 2;

    /** Тип String */
    const TYPE_STRING = 3;

    /** Тип Дата */
    const TYPE_DATE = 4;

    /** Тип Boolean */
    const TYPE_BOOL = 5;

    /** Тип Array */
    const TYPE_ARRAY = 6;

    /** @var array Массив значений модели */
    protected $list = [];

    /**
     * Read constructor.
     * @param array $list
     */
    public function __construct($list = [])
    {
        $this->setElementsList($list);
    }

    /**
     * Уставливаем данные ддля модели
     * @param array $list Список значений для модели
     */
    public function setElementsList(array $list)
    {
        $this->list = $list;
    }

    /**
     * Получаем данные модели
     * @return array Данные модели
     */
    public function getElementsList()
    {
        return $this->list;
    }

    /**
     * Получаем значение
     * @param string $name Имя метода
     * @return mixed|null Значение
     */
    public function __get(string $name)
    {
        return $this->get($name);
    }

    /**
     * Получваем по название ключа значение
     * @param string $name Название ключа
     * @return mixed|null Значение
     */
    protected function get(string $name)
    {
        $name[0] = strtolower($name[0]);
        return isset($this->list[$name]) ? $this->list[$name] : null;
    }

    /**
     * Обработка магического метода
     * @param string $methodName Название метода
     * @param array $arguments аргументы
     * @return mixed|null Значение
     */
    public function __call(string $methodName, $arguments)
    {
        if (substr($methodName, 0, 3) === 'get') {
            return $this->get(substr($methodName, 3));
        } elseif (substr($methodName, 0, 2) === 'is') {
            return $this->get(substr($methodName, 2));
        }

        return $this->get($methodName);
    }
}
