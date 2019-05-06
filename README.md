# Copyscape Laravel Interface

## What is it?

A Laravel package that provides a [Copyscape](https://copyscape.com) interface for their premium API.


## Installation

        composer require juanparati/copyscape

For Laravel 5.5 it is required to register the service provider into the "config/app.php":

        Juanparati\Copyscape\CopyscapeServiceProvider::class,

For Laravel 5.6+ the service provider is automatically registered.

## Configuration

        artisan vendor:publish --provider="Juanparati\Copyscape\CopyscapeServiceProvider"                    

## Alias

Optionally add the following Alias in your config/app.php (Aliases section):

        'Copyscape' => Juanparati\Copyscape\Facades\CopyscapeClient::class, 

## Usage examples

### Search against URL

        // Search without full comparison.
        $results = Copyscape::searchURL('http://example.net')->request();
        
        // With optional options
        $search = Copyscape::searchURL('https://en.wikipedia.org/wiki/United_States_Declaration_of_Independence');
        
        $search->setFullComparison(5);  // Set full comparison (0 for disable, 1-10 for full comparison)
        $search->setIgnoreSites(['britannica.com']);
        $search->setSpendLimit(0.1);
        $search->setTestMode(true);
        
        $results = $search->request();
        

### Search against a text


         // Search without full comparison
         $results = Copyscape::searchText('We must, therefore, acquiesce in the necessity, which denounces our Separation, and hold them, as we hold the rest of mankind, Enemies in War, in Peace Friends.')->request();
         
         // With optional options       
         $search = Copyscape::searchText('We must, therefore, acquiesce in the necessity, which denounces our Separation, and hold them, as we hold the rest of mankind, Enemies in War, in Peace Friends.');
         
         $search->setFullComparison(5);  // Set full comparison (0 for disable, 1-10 for full comparison)
         $search->setIgnoreSites(['britannica.com']);
         $search->setSpendLimit(0.1);
         $search->setTestMode(true);
         
         $results = $search->request();
         

### Search types

It's possible to change the possible search type using the "setSearchType" method:

        Copyscape::searchText('Hello Universe')
            ->setSearchType(\Juanparati\Copyscape\Services\SearchService::SEARCH_TYPE_PRIVATE)
            ->request();
            
The following search types are available:

        \Juanparati\Copyscape\Services\SearchService::SEARCH_TYPE_PUBLIC    // Search against public index
        \Juanparati\Copyscape\Services\SearchService::SEARCH_TYPE_PRIVATE   // Search against private index
        \Juanparati\Copyscape\Services\SearchService::SEARCH_TYPE_BOTH      // Search against public and private indexes   
        

               
         
         
### Add index from URL

In order to use the private index, remember to [create a private index](https://www.copyscape.com/faqs.php#privateindex) from the Copyscape interface

        $results = Copyscape::indexURL('http://example.net', 'my_index_id');


### Add index from Text

        $results = Copyscape::indexText('Hello World', 'my_index_id');


### Get the credit balance

        $results = Copyscape::getBalance();
