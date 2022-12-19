<?php

namespace Nasirinezhad\AzarmessageApi;

class Recipient
{
    private $n, $sr, $c, $p, $sa, $ea, $g, $t, $id = 'zone';

    public function __construct(Int $zoneID, Int $total) {
        $this->n = $zoneID;
        $this->c = $total;
    }
    public function zoneID(Int $zoneID)
    {
        $this->n = $zoneID;
        return $this;
    }
    public function offset(Int $offset)
    {
        $this->sr = $offset;
        return $this;
    }
    public function total(Int $total)
    {
        $this->c = $total;
        return $this;
    }
    public function prefix(Int $prefix)
    {
        $this->p = $prefix;
        return $this;
    }
    public function minimumAge($age)
    {
        $this->sa = $age;
        return $this;
    }
    public function maxmumAge($age)
    {
        $this->ea = $age;
        return $this;
    }
    public function onlyMen()
    {
        $this->g = 1;
        return $this;
    }
    public function onlyWomen()
    {
        $this->g = 0;
        return $this;
    }
    public function MenAndWomen()
    {
        $this->g = 2;
        return $this;
    }
    public function permanentOnly()
    {
        $this->t = 0;
        return $this;
    }
    public function prepaidOnly()
    {
        $this->t = 1;
        return $this;
    }
    public function all()
    {
        $this->t = 2;
        return $this;
    }
    public function xml()
    {
        $body = "<r id=\"$this->id\">\n";
        if ($this->sr) {
            $body .= "<sr>$this->sr</sr>\n";
        }
        $body .= "<c>$this->c</c>\n";
        if ($this->p) {
            $body .= "<p>$this->p</p>\n";
        }
        if ($this->sa) {
            $body .= "<sa>$this->sa</sa>\n";
        }
        if ($this->ea) {
            $body .= "<ea>$this->ea</ea>\n";
        }
        if ($this->g) {
            $body .= "<g>$this->g</g>\n";
        }
        if ($this->t) {
            $body .= "<t>$this->t</t>\n";
        }
        $body .= '</r>';
        return $body;
    }
}
