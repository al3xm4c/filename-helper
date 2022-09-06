<?php

namespace Alexmac\FilenameHelper;

use DateTime;
use JsonSerializable;
use Stringable;

class Filename implements JsonSerializable, Stringable
{
    private $parts;
    private $date = null;
    private $separator = '_';
    private $extension = null;

    public function __construct(?string $name)
    {
        $this->parts[] = $name;
    }

    public static function create(?string $name): Filename
    {
        return new static($name);
    }

    public function append(?string $string): Filename
    {
        array_push($this->parts, $string);
        return $this;
    }
    
    public function prepend(?string $string): Filename
    {
        array_unshift($this->parts, $string);
        return $this;
    }

    public function setDate(DateTime $dateTime): Filename
    {
        $this->date = $dateTime;
        return $this;
    }

    private function getFormattedDate()
    {
        $format = implode($this->separator, ['Y', 'm', 'd']);

        return $this->date
            ? $this->date->format($format)
            : null;
    }

    public function setSeparator(string $separator): Filename
    {
        $this->separator = $separator;
        return $this;
    }

    public function setExtension(string $extension): Filename
    {
        $this->extension = $extension;
        return $this;
    }

    public function toString(): string
    {
        $filename = $this->parts;
        array_unshift($filename, $this->getFormattedDate());
        $filename = array_filter($filename);
        $filename = implode($this->separator, $filename);
        
        if ($this->extension) {
            $filename .= ".{$this->extension}";
        }
        
        return $filename;
    }

    public function __toString()
    {
        return $this->toString();
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->toString();
    }
}
