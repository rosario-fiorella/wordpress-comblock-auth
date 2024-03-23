<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_Data_Mapper
{
    /**
     * @since 1.0.0
     * @access protected
     * @var array<string, mixed> $data
     */
    protected array $data = [];

    /**
     * @since 1.0.0
     * @param string $key
     * @return null|mixed
     */
    public function __get($key)
    {
        return array_key_exists($key, $this->data) ? $this->data[$key] : null;
    }

    /**
     * @since 1.0.0
     * @param string $key
     * @param string $value
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @since 1.0.0
     * @return array<string, mixed>
     */
    public function to_array(): array
    {
        return $this->data;
    }
}
