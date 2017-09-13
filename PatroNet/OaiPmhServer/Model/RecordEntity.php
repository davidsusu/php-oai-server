<?php

namespace PatroNet\OaiPmhServer\Model;

interface RecordEntity {
    
    /**
     * @return string
     */
    public function getLastChangeUtcDateTime();
    
    /**
     * @return boolean
     */
    public function isDeleted();
    
    /**
     * @param boolean $deleted
     */
    public function setDeleted($deleted);
    
    public function requestDeletion();
    
    /**
     * @return string
     */
    public function getIdentifier();
    
    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier);
    
    
    
    
    /**
     * @return SetEntity|null
     */
    public function getSet();
    
    /**
     * @return \Traversable|\Countable|SetEntity[]
     */
    public function getSets();
    
    /**
     * @param SetEntity|int
     */
    public function setSet($idOrSetEntity);
    
    /**
     * @param \Traversable|SetEntity[]|int[]|mixed[]
     */
    public function setSets($sets);
    
    
    
    
    /**
     * @param string $key
     * @return string|null
     */
    public function getMetaValue($key);
    
    /**
     * @param string $key
     * @return string[]
     */
    public function getMetaValues($key);
    
    /**
     * @param string $key
     * @param string|null $value
     */
    public function setMetaValue($key, $value);
    
    /**
     * @param string $key
     * @param string[] $values
     */
    public function setMetaValues($key, $values);
    
    
    
    
    
    /* Dublin Core fields */
    
    
    /**
     * @return string|null
     */
    public function getTitle();
    
    /**
     * @return string[]
     */
    public function getTitles();
    
    /**
     * @param string|null $title
     */
    public function setTitle($title);
    
    /**
     * @param string[] $titles
     */
    public function setTitles($titles);
    
    
    
    
    /**
     * @return string|null
     */
    public function getCreator();
    
    /**
     * @return string[]
     */
    public function getCreators();
    
    /**
     * @param string|null $creator
     */
    public function setCreator($creator);
    
    /**
     * @param string[] $creators
     */
    public function setCreators($creators);
    
    
    
    
    /**
     * @return string|null
     */
    public function getSubject();
    
    /**
     * @return string[]
     */
    public function getSubjects();
    
    /**
     * @param string|null $subject
     */
    public function setSubject($subject);
    
    /**
     * @param string[] $subjects
     */
    public function setSubjects($subjects);
    
    
    
    
    /**
     * @return string|null
     */
    public function getDescription();
    
    /**
     * @return string[]
     */
    public function getDescriptions();
    
    /**
     * @param string|null $description
     */
    public function setDescription($description);
    
    /**
     * @param string[] $descriptions
     */
    public function setDescriptions($descriptions);
    
    
    
    
    /**
     * @return string|null
     */
    public function getPublisher();
    
    /**
     * @return string[]
     */
    public function getPublishers();
    
    /**
     * @param string|null $publisher
     */
    public function setPublisher($publisher);
    
    /**
     * @param string[] $publishers
     */
    public function setPublishers($publishers);
    
    
    
    
    /**
     * @return string|null
     */
    public function getContributor();
    
    /**
     * @return string[]
     */
    public function getContributors();
    
    /**
     * @param string|null $contributor
     */
    public function setContributor($contributor);
    
    /**
     * @param string[] $contributors
     */
    public function setContributors($contributors);
    
    
    
    
    /**
     * @return string|null
     */
    public function getDate();
    
    /**
     * @return string[]
     */
    public function getDates();
    
    /**
     * @param string|null $date
     */
    public function setDate($date);
    
    /**
     * @param string[] $dates
     */
    public function setDates($dates);
    
    
    
    
    /**
     * @return string|null
     */
    public function getType();
    
    /**
     * @return string[]
     */
    public function getTypes();
    
    /**
     * @param string|null $type
     */
    public function setType($type);
    
    /**
     * @param string[] $types
     */
    public function setTypes($types);
    
    
    
    /**
     * @return string|null
     */
    public function getFormat();
    
    /**
     * @return string[]
     */
    public function getFormats();
    
    /**
     * @param string|null $format
     */
    public function setFormat($format);
    
    /**
     * @param string[] $formats
     */
    public function setFormats($formats);
    
    
    
    
    /**
     * @return string|null
     */
    public function getSource();
    
    /**
     * @return string[]
     */
    public function getSources();
    
    /**
     * @param string|null $source
     */
    public function setSource($source);
    
    /**
     * @param string[] $sources
     */
    public function setSources($sources);
    
    
    
    
    /**
     * @return string|null
     */
    public function getLanguage();
    
    /**
     * @return string[]
     */
    public function getLanguages();
    
    /**
     * @param string|null $language
     */
    public function setLanguage($language);
    
    /**
     * @param string[] $languages
     */
    public function setLanguages($languages);
    
    
    
    
    /**
     * @return string|null
     */
    public function getRelation();
    
    /**
     * @return string[]
     */
    public function getRelations();
    
    /**
     * @param string|null $relation
     */
    public function setRelation($relation);
    
    /**
     * @param string[] $relations
     */
    public function setRelations($relations);
    
    
    
    
    /**
     * @return string|null
     */
    public function getCoverage();
    
    /**
     * @return string[]
     */
    public function getCoverages();
    
    /**
     * @param string|null $coverage
     */
    public function setCoverage($coverage);
    
    /**
     * @param string[] $coverages
     */
    public function setCoverages($coverages);
    
    
    
    
    /**
     * @return string|null
     */
    public function getRights();
    
    /**
     * @return string[]
     */
    public function getRightses();
    
    /**
     * @param string|null $rights
     */
    public function setRights($rights);
    
    /**
     * @param string[] $rightses
     */
    public function setRightses($rightses);
    
    
    
    
}
