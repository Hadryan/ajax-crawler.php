/**
 * Implementation of the `ajaxCrawler.core.Crawler` class.
 * @module core.Crawler
 */
'use strict';

// Module dependencies.
var system=require('system');
var webpage=require('webpage');

/**
 * Crawls Web pages and returns their content.
 * @class ajaxCrawler.core.Crawler
 * @constructor
 */
function Crawler() {}

/**
 * Loads the web page located at the specified URL and returns its HTML content.
 * @method fetch
 * @param {String} url The URL to be loaded.
 * @param {Function} callback The function to invoke when the page has been loaded.
 *  It is passed two arguments `(err, html)` providing the error that occurred if any, and the HTML content of the loaded page.
 * @async
 */
Crawler.prototype.fetch=function(url, callback) {
  var page=webpage.create();
  page.open(url, function(status) {
    if(status!='success') callback(new Error(status));
    callback(null, page.content);
  });
};

/**
 * Runs the crawler.
 * @method main
 * @param {Array} args The command line arguments.
 * @static
 */
Crawler.main=function(args) {
  if(!args.length) phantom.exit(400);
  new Crawler().fetch(args[0], function(err, html) {
    if(err) phantom.exit(500);
    console.log(html);
    phantom.exit(0);
  });
};

// Start the application.
Crawler.main(system.args.slice(1));
