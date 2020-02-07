<?php namespace Admin\Models;

/**
 * Pages Model Class
 *
 * @package Admin
 */
class Pages_model extends \System\Models\Pages_model
{
    protected $fillable = ['language_id', 'name', 'title', 'heading', 'content', 'meta_description',
        'meta_keywords', 'layout_id', 'navigation', 'date_added', 'date_updated', 'status'];

    public function getContentAttribute($value)
    {
        return html_entity_decode($value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['heading'] = $value;
        $this->attributes['name'] = $value;
    }

    public function getMorphClass()
    {
        return 'pages';
    }

    public function scopeListFrontEnd($query, $options = [])
    {
        extract(array_merge([
            'page' => 1,
            'pageLimit' => 20,
            'customer' => null,
            'location' => null,
            'sort' => 'pages_id desc',
        ], $options));

        if (!is_array($sort)) {
            $sort = [$sort];
        }

        foreach ($sort as $_sort) {
            if (in_array($_sort, self::$allowedSortingColumns)) {
                $parts = explode(' ', $_sort);
                if (count($parts) < 2) {
                    array_push($parts, 'desc');
                }
                list($sortField, $sortDirection) = $parts;
                $query->orderBy($sortField, $sortDirection);
            }
        }

        return $query->paginate($pageLimit, $page);
    }
}