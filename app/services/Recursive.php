<?php


namespace app\services;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Class Recursive
 *
 * @property string $targetDir
 * @property string $resultDir
 * @property string $extensions
 *
 * @package app\services
 */
class Recursive
{
    const TARGET_DIR = __DIR__ . '/../../struct';
    const RESULT_DIR = __DIR__ . '/../../result';

    /**
     * @var string
     */
    private $targetDir;

    /**
     * @var string
     */
    private $resultDir;

    /**
     * @var string
     */
    private $extensions;

    /**
     * Recursive constructor.
     * @param string|null $target
     * @param string|null $result
     * @param string $extensions
     */
    public function __construct(string $target = null, string $result = null, string $extensions = null)
    {
        $this->targetDir = $target ?? self::TARGET_DIR;
        $this->resultDir = $result ?? self::RESULT_DIR;
        $this->extensions = $extensions ?? 'php,html,js';
    }

    public function getStruct()
    {
        if ($this->prepare()) {
            $struct = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(
                $this->targetDir,
                RecursiveDirectoryIterator::SKIP_DOTS), TRUE);

            $this->buildNewStruct($struct);

            echo "done\n";
        } else {
            echo "target folder is invalid\n";
        }
    }

    private function prepare()
    {
        if (!file_exists($this->targetDir)) {
            return false;
        }

        if (!file_exists($this->resultDir)) {
            mkdir($this->resultDir);
        }

        return true;
    }

    /**
     * @param RecursiveIteratorIterator $struct
     */
    private function buildNewStruct(RecursiveIteratorIterator $struct)
    {
        $extensions = explode(',', $this->extensions);

        foreach ($struct as $path => $file) {
            if ($file->isFile()) {
                if (in_array($this->getFileExtension($file->getFilename()), $extensions)) {
                    $filePath = $this->getNewPath($path, 'pdf');
                    copy($path, $filePath);
                }
            } else {
                mkdir($this->getNewPath($path));
            }
        }
    }

    /**
     * @param string $filename
     * @return false|string
     */
    private function getFileExtension(string $filename)
    {
        return substr(strrchr($filename, '.'), 1);
    }

    /**
     * @param string $path
     * @param string|null $extension
     * @return string
     */
    private function getNewPath(string $path, string $extension = null): string
    {
        $name = str_replace($this->targetDir, $this->resultDir, $path);

        if ($extension) {
            $name .= ".{$extension}";
        }

        return $name;
    }
}