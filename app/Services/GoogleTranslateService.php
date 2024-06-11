<?php

namespace App\Services;

use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Support\Facades\Cache;
use stdClass;

class GoogleTranslateService
{
    protected $client;

    public function __construct()
    {
        $this->client = new TranslateClient([
            'key' => config('services.google_translate.key'),
        ]);
    }

    // public function translate($key, $text, $targetLanguage)
    // {

    //     $cacheKey =  $key . $text .":".app()->getLocale();;
    //     dd($cacheKey);
    //     if (Cache::has($cacheKey)) {
    //         $translation = Cache::get($cacheKey);
    //     } else {
    //         $translation = $this->client->translate($text, [
    //             'target' => $targetLanguage,
    //         ]);

    //         Cache::put($cacheKey, $translation, now()->addHour());
    //     }

    //     return $translation['text'];
    // }

    public function translate($key, $text, $targetLanguage)
    {
        $translation = $this->client->translate($text, [

            'target' => $targetLanguage,
        ]);

        return $translation['text'];
    }

    public function detectLanguage($text)
    {
        $trans = $this->client->detectLanguage($text);

        return $trans['languageCode'];
    }

    public function detectLanguagesBatch($texts)
    {
        $results = $this->client->detectLanguageBatch($texts);
        $detectedLanguages = [];
        foreach ($results as $result) {
            $detectedLanguages[] = $result['language'];
        }

        return $detectedLanguages;
    }

    public function translatePulledData($languageUsed,)
    {
        $listArray = explode(',', config('app.local_list'));

        if (in_array($languageUsed, $listArray)) {
            $index = array_search($languageUsed, $listArray);
            $matchingLanguage = $listArray[$index];
            dd($matchingLanguage);
        } else {
            dd("not match");
        }
    }
    // use this for ->get() format in database
    public function filterGETTranslate($database, $keyName, $targetColumns)
    {

        // $translations = [];
        // foreach ($database as $item) {

        //     foreach ($targetColumns as $column) {
        //         $translationKey = $keyName . $column . ":" . app()->getLocale();

        //         if (isset($item->$column)) {
        //             $cacheKey = $translationKey . $item->$column;

        //             if (Cache::has($cacheKey)) {

        //                 $translation = Cache::get($cacheKey);

        //                 // $translation = $translation['text'];

        //             } else {
        //                 $translatedValue = self::translate($translationKey, $item->$column, app()->getLocale());
        //                 Cache::put($cacheKey, $translatedValue, now()->addHour());
        //                 $translation = $translatedValue;
        //             }


        //             $originalAttributes = $item->getOriginal();

        //             $originalAttributes[$column] = $translation;

        //             $item->setRawAttributes($originalAttributes, true);
        // $cacheKey = "{$translationKey}:{$locale}:{$item->$column}";
        //         }
        //     }
        //     $translations[] = $item;
        // }
        // return $translations;
        $translations = [];
        foreach ($database as $item) {
           
            foreach ($targetColumns as $column) {
                $translationKey = $keyName . $column . ":" . app()->getLocale();

                if (isset($item->$column)) {
                    $cacheKey = $translationKey . $item->$column;
                    
                    $translatedValue = self::translate($translationKey, $item->$column, app()->getLocale());

                    if (Cache::has($cacheKey)) {

                        $translation = Cache::get($cacheKey);

                        // $translation = $translation['text'];

                    } else {
                        $translatedValue = self::translate($translationKey, $item->$column, app()->getLocale());
                        Cache::put($cacheKey, $translatedValue, now()->addHour());
                        $translation = $translatedValue;
                    }


                    $originalAttributes = $item->getOriginal();

                    $originalAttributes[$column] = $translation;

                    $item->setRawAttributes($originalAttributes, true);
                }
            }
            $translations[] = $item;
        }
        return $translations;
    }
    // use for rendering games 
    public function filterCustomTranslateGames($database, $keyName, $targetColumns)
    {
        $translations = [];
        foreach ($database as $item) {

            foreach ($targetColumns as $column) {

                $translationKey = $keyName . $column . ":" . app()->getLocale();

                if (isset($item->$column)) {
                    $cacheKey = $translationKey . $item->$column;

                    if (Cache::has($cacheKey)) {

                        $translation = Cache::get($cacheKey);

                        // $translation = $translation['text'];

                    } else {
                        $translatedValue = self::translate($translationKey, $item->$column, app()->getLocale());

                        Cache::put($cacheKey, $translatedValue, now()->addHour());
                        $translation = $translatedValue;
                    }

                    $item->$column = $translation;
                }
            }


            $translations[] = $item;
        }
        return $translations;
    } 


    // use this for straightforward format
    public function filterCustomTranslate($database, $keyName, $targetColumns)
    {   
      
        $translations = [];
        foreach ($database as $item) {

            foreach ($targetColumns as $column) {

                $translationKey = $keyName . $column . ":" . app()->getLocale();
               
                if (isset($item->$column)) {
                    $cacheKey = $translationKey . $item->$column;

                    if (Cache::has($cacheKey)) {

                        $translation = Cache::get($cacheKey);

                        // $translation = $translation['text'];

                    } else {
                        $translatedValue = self::translate($translationKey, $item->$column, self::detectLanguage($item->$column),app()->getLocale());

                        Cache::put($cacheKey, $translatedValue, now()->addHour());
                        $translation = $translatedValue;
                    }

                    $item->$column = $translation;
                }
            }


            $translations[] = $item;
        }
        return $translations;
    }
    public function filterCustomTranslate2($database, $keyName, $targetColumns)
    {   
      
        $translations = [];
        foreach ($database as $item) {

            foreach ($targetColumns as $column) {

                $translationKey = $keyName . $column . ":" . app()->getLocale();
               
                if (isset($item->$column)) {
                    $cacheKey = $translationKey . $item->$column;

                    if (Cache::has($cacheKey)) {

                        $translation = Cache::get($cacheKey);

                        // $translation = $translation['text'];

                    } else {
                        $translatedValue = self::translate($translationKey, $item->$column, app()->getLocale());

                        Cache::put($cacheKey, $translatedValue, now()->addHour());
                        $translation = $translatedValue;
                    }

                    $item->$column = $translation;
                }
            }


            $translations[] = $item;
        }
        return $translations;
    }
    // use for single line translateing
    public function filterSingleLineTranslate($item, $keyName, $targetColumns)
    {
        $translations = [];
        foreach ($targetColumns as $column) {
            $translationKey = $keyName . $column . ":" . app()->getLocale();

            if (isset($item->$column)) {
                $cacheKey = $translationKey . $item->$column;

                if (Cache::has($cacheKey)) {

                    $translation = Cache::get($cacheKey);
                } else {

                    $translatedValue = self::translate($translationKey, $item->$column, self::detectLanguage($item->$column),app()->getLocale());
                    Cache::put($cacheKey, $translatedValue, now()->addHour());
                    $translation = $translatedValue;
                }

                $item->$column = $translation;
            }
        }

        return $translations = $item;
    }

    // public function pullFirstTranslate($item, $keyName, $targetColumns)
    // {
    //     dd($item);
    // }

    // public function filterTranslate($database, $keyName, $targetColumns)
    // {
    //     $translations = [];
    //     foreach ($database as $item) {
    //         $newColumns = array_map(function ($columnItem) use ($keyName, $targetColumns) {
    //             foreach ($columnItem->getAttributes() as $column => $value) {
    //                 if (in_array($column, $targetColumns)) {
    //                     $cacheKey = $keyName . $column;
    //                     if (Cache::has($cacheKey)) {
    //                         $translation = Cache::get($cacheKey);
    //                     } else {
    //                         $translatedValue = self::translate($cacheKey, $value, app()->getLocale());
    //                         Cache::put($cacheKey, $translatedValue, now()->addHour());
    //                         $translation = $translatedValue;
    //                     }
    //                     $columnItem->$column = $translation;
    //                 }
    //             }
    //             return $columnItem;
    //         }, [$item]);
    //         $translations[] = $newColumns[0];
    //     }
    //     return $translations;
    // }


    // public function filterTranslate($database, $keyName, $targetColumns)
    // {
    //     $translations = [];
    //     foreach ($database as $item) {
    //         $newColumns = array_map(function ($columnItem) use ($keyName, $item) {

    //             foreach ($item->getAttributes() as $column => $value) {

    //                 if ($column == $columnItem) {
    //                    return $cacheKey = $keyName . $column;


    //                     if (Cache::has($cacheKey)) {
    //                         $translation = Cache::get($cacheKey);
    //                     } else {
    //                         $translatedValue = self::translate($cacheKey, $value, app()->getLocale());
    //                         Cache::put($cacheKey, $translatedValue, now()->addHour());
    //                         $translation = $translatedValue;
    //                     }

    //                     $columnItem->$column = $translation;
    //                     continue;
    //                 }
    //                 dd("asd");
    //                // return $columnItem;

    //             }

    //         }, $targetColumns);

    //         $item->setRawAttributes($newColumns);
    //         $translations[] = $item;

    //     }
    //     return $translations;
    // }
}
