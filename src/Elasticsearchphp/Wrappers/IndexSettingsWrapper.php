<?php

namespace Elasticsearchphp\Wrappers;

/**
 * @todo add index.routing.allocation.include/exclude
 *
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper number_of_replicas() number_of_replicas(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper auto_expand_replicas() auto_expand_replicas(\string $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper refresh_interval() refresh_interval(\string $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper term_index_interval() term_index_interval(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper term_index_divisor() term_index_divisor(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper gc_deletes() gc_deletes()
 *
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper blocks__read_only() blocks__read_only(\bool $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper blocks__read() blocks__read(\bool $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper blocks__write() blocks__write(\bool $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper blocks__metadata() blocks__metadata(\bool $value)
 *
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper translog__flush_threshold_ops() translog__flush_threshold_ops(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper translog__flush_threshold_size() translog__flush_threshold_size(\string $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper translog__flush_threshold_period() translog__flush_threshold_period(\string $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper translog__disable_flush() translog__disable_flush(\int $value)
 *
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper cache__filter__max_size() cache__filter__max_size(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper cache__filter__expire() cache__filter__expire(\string $value)
 *
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper gateway__snapshot_interval() gateway__snapshot_interval(\string $value)
 *
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper recovery__initial_shards() recovery__initial_shards(\int $value)
 *
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper ttl__disable_purge() ttl__disable_purge(\bool $value)
 *
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__policy__expunge_deletes_allowed() merge__policy__expunge_deletes_allowed(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__policy__floor_segment() merge__policy__floor_segment(\string $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__policy__max_merge_at_once() merge__policy__max_merge_at_once(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__policy__max_merge_at_once_explicit() merge__policy__max_merge_at_once_explicit(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__policy__max_merged_segment() merge__policy__max_merged_segment(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__policy__segments_per_tier() merge__policy__segments_per_tier(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper reclaim_deletes_weight() reclaim_deletes_weight(\float $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper compound_format() compound_format(\bool $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__scheduler__max_thread_count() merge__scheduler__max_thread_count(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__policy__merge_factor() merge__policy__merge_factor(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__policy__min_merge_size() merge__policy__min_merge_size(\string $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__policy__max_merge_size() merge__policy__max_merge_size(\string $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__policy__maxMergeDocs() merge__policy__maxMergeDocs(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__policy__min_merge_docs() merge__policy__min_merge_docs(\int $value)
 * @method \Elasticsearchphp\Wrappers\IndexSettingsWrapper merge__policy__max_merge_docs() merge__policy__max_merge_docs(\int $value)
 */
class IndexSettingsWrapper
{
    /**
     * @var array
     */
    protected $params;


    public function __call($name, $arguments)
    {
        $name = str_replace("__", ".", $name);
        $this->params[$name] = $arguments[0];

        return $this;
    }


    public function toArray()
    {
        return $this->params;
    }

}