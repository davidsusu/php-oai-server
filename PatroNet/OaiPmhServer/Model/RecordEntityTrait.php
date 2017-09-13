<?php

namespace PatroNet\OaiPmhServer\Model;

trait RecordEntityTrait {
    
    
    public function getSet() {
        foreach ($this->getSets() as $set) {
            return $set;
        }
        return null;
    }
    
    public function setSet($idOrSetEntity) {
        return $this->setSets([$idOrSetEntity]);
    }
    
    
    
    public function getMetaValue($key) {
        foreach ($this->getMetaValues($key) as $metaValue) {
            return $metaValue;
        }
        return null;
    }
    
    public function setMetaValue($key, $value) {
        return $this->setMetaValues($key, [$value]);
    }
    
    
    
    
    
    /* Dublin Core fields */
    
    
    public function getTitle() {
        return $this->getMetaValue("title");
    }
    
    public function getTitles() {
        return $this->getMetaValues("title");
    }
    
    public function setTitle($title) {
        return $this->setMetaValue("title", $title);
    }
    
    public function setTitles($titles) {
        return $this->setMetaValues("title", $titles);
    }
    
    
    
    public function getCreator() {
        return $this->getMetaValue("creator");
    }
    
    public function getCreators() {
        return $this->getMetaValues("creator");
    }
    
    public function setCreator($creator) {
        return $this->setMetaValue("creator", $creator);
    }
    
    public function setCreators($creators) {
        return $this->setMetaValues("creator", $creators);
    }
    
    
    
    
    public function getSubject() {
        return $this->getMetaValue("subject");
    }
    
    public function getSubjects() {
        return $this->getMetaValues("subject");
    }
    
    public function setSubject($subject) {
        return $this->setMetaValue("subject", $subject);
    }
    
    public function setSubjects($subjects) {
        return $this->setMetaValues("subject", $subjects);
    }
    
    
    
    
    public function getDescription() {
        return $this->getMetaValue("description");
    }
    
    public function getDescriptions() {
        return $this->getMetaValues("description");
    }
    
    public function setDescription($description) {
        return $this->setMetaValue("description", $description);
    }
    
    public function setDescriptions($descriptions) {
        return $this->setMetaValues("description", $descriptions);
    }
    
    
    
    
    public function getPublisher() {
        return $this->getMetaValue("publisher");
    }
    
    public function getPublishers() {
        return $this->getMetaValues("publisher");
    }
    
    public function setPublisher($publisher) {
        return $this->setMetaValue("publishers", $publisher);
    }
    
    public function setPublishers($publishers) {
        return $this->setMetaValues("publishers", $publishers);
    }
    
    
    
    
    public function getContributor() {
        return $this->getMetaValue("contributor");
    }
    
    public function getContributors() {
        return $this->getMetaValues("contributor");
    }
    
    public function setContributor($contributor) {
        return $this->setMetaValue("contributor", $contributor);
    }
    
    public function setContributors($contributors) {
        return $this->setMetaValues("contributor", $contributors);
    }
    
    
    
    
    public function getDate() {
        return $this->getMetaValue("date");
    }
    
    public function getDates() {
        return $this->getMetaValues("date");
    }
    
    public function setDate($date) {
        return $this->setMetaValue("date", $date);
    }
    
    public function setDates($dates) {
        return $this->setMetaValues("date", $dates);
    }
    
    
    
    
    public function getType() {
        return $this->getMetaValue("type");
    }
    
    public function getTypes() {
        return $this->getMetaValues("type");
    }
    
    public function setType($type) {
        return $this->setMetaValue("type", $type);
    }
    
    public function setTypes($types) {
        return $this->setMetaValues("type", $types);
    }
    
    
    
    
    public function getFormat() {
        return $this->getMetaValue("format");
    }
    
    public function getFormats() {
        return $this->getMetaValues("format");
    }
    
    public function setFormat($format) {
        return $this->setMetaValue("format", $format);
    }
    
    public function setFormats($formats) {
        return $this->setMetaValues("format", $formats);
    }
    
    
    
    
    public function getSource() {
        return $this->getMetaValue("source");
    }
    
    public function getSources() {
        return $this->getMetaValues("source");
    }
    
    public function setSource($source) {
        return $this->setMetaValue("source", $source);
    }
    
    public function setSources($sources) {
        return $this->setMetaValues("source", $sources);
    }
    
    
    
    
    public function getLanguage() {
        return $this->getMetaValue("language");
    }
    
    public function getLanguages() {
        return $this->getMetaValues("language");
    }
    
    public function setLanguage($language) {
        return $this->setMetaValue("language", $language);
    }
    
    public function setLanguages($languages) {
        return $this->setMetaValues("language", $languages);
    }
    
    
    
    
    public function getRelation() {
        return $this->getMetaValue("relation");
    }
    
    public function getRelations() {
        return $this->getMetaValues("relation");
    }
    
    public function setRelation($relation) {
        return $this->setMetaValue("relation", $relation);
    }
    
    public function setRelations($relation) {
        return $this->setMetaValues("relation", $relation);
    }
    
    
    
    
    public function getCoverage() {
        return $this->getMetaValue("coverage");
    }
    
    public function getCoverages() {
        return $this->getMetaValues("coverage");
    }
    
    public function setCoverage($coverage) {
        return $this->setMetaValue("coverage", $coverage);
    }
    
    public function setCoverages($coverages) {
        return $this->setMetaValues("coverage", $coverages);
    }
    
    
    
    
    public function getRights() {
        return $this->getMetaValue("rights");
    }
    
    public function getRightses() {
        return $this->getMetaValues("rights");
    }
    
    public function setRights($rights) {
        return $this->setMetaValue("rights", $rights);
    }
    
    public function setRightses($rightses) {
        return $this->setMetaValues("rights", $rightses);
    }
    
    
    
    
}
