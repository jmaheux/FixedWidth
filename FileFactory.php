<?php
/**
 * Created by PhpStorm.
 * User: jderay
 * Date: 9/4/14
 * Time: 10:10 PM
 */

namespace Giftcards\FixedWidth;


use Giftcards\FixedWidth\Spec\Loader\SpecLoaderInterface;
use Giftcards\FixedWidth\Spec\Recognizer\RecordSpecRecognizerInterface;
use Giftcards\FixedWidth\Spec\ValueFormatter\SprintfValueFormatter;
use Giftcards\FixedWidth\Spec\ValueFormatter\ValueFormatterInterface;

class FileFactory
{
    public function create($name, $width, $lineSeparator = "\r\n")
    {
        return new File($name, $width, array(), $lineSeparator);
    }

    public function createFromFile(\SplFileInfo $file, $lineSeparator = "\r\n")
    {
        $lines = explode($lineSeparator, file_get_contents($file->getRealPath()));

        if (!($width = strlen($lines[0]))) {

            throw new \InvalidArgumentException('The file you\'ve passed is empty and therefore the width cannot be inferred.');
        }

        return new File(
            $file->getFilename(),
            $width,
            $lines
        );
    }
} 