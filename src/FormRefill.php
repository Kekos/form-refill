<?php declare(strict_types=1);

namespace Kekos\FormRefill;

use function explode;
use function htmlspecialchars;
use function sprintf;

final class FormRefill
{
    /** @var array<string, string>|array<string, array> */
    private $post_data = [];

    /**
     * @param array<string, string>|array<string, array> $post_data
     */
    public function setPostData(array $post_data): void
    {
        $this->post_data = $post_data;
    }

	/**
	 * @param mixed $default
	 */
    public function getDataAtPath(string $path, $default): string
    {
        $exploded = explode('.', $path);
        $temp = &$this->post_data;
        foreach ($exploded as $key) {
            if (!isset($temp[$key])) {
                return (string) $default;
            }

            $temp = &$temp[$key];
        }

        return $temp;
    }

	/**
	 * @param mixed $default
	 */
    public function refillText(string $path, $default = ''): string
    {
        $value = $this->getDataAtPath($path, $default);

        return sprintf(' value="%s"', htmlspecialchars($value));
    }

	/**
	 * @param mixed $default
	 */
    public function refillRadio(string $path, string $value, $default = ''): string
    {
        $data = $this->getDataAtPath($path, $default);
        if ($data === $value) {
            return ' checked';
        }

        return '';
    }

	/**
	 * @param mixed $default
	 */
    public function refillCheckbox(string $path, string $value, $default = ''): string
    {
        return $this->refillRadio($path, $value, $default);
    }

	/**
	 * @param mixed $default
	 */
    public function refillTextarea(string $path, $default = ''): string
    {
        $value = $this->getDataAtPath($path, $default);

        return htmlspecialchars($value);
    }

	/**
	 * @param mixed $default
	 */
    public function refillOption(string $path, string $value, $default = ''): string
    {
        $data = $this->getDataAtPath($path, $default);
        if ($data === $value) {
            return ' selected';
        }

        return '';
    }
}
