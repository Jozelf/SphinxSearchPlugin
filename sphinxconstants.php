<?php

define ('STOP_WORDS_FILE', PATH_PLUGINS . DS . 'SphinxSearchLite' . DS . 'assests'. DS .'stop_words.txt');
define ('WORD_FORMS_FILE', PATH_PLUGINS . DS . 'SphinxSearchLite' . DS . 'assests'. DS .'word_forms.txt');

//error logs
define ('SS_SUCCESS', 1);
define ('SS_WARNING', 2);
define ('SS_FATAL_ERROR', 3);

//@todo should be a setting
define ('SS_PREVIEW_BODY_LIMIT', 150); //@todo delete this - tooltip hover preview limit
define ('SS_BODY_LIMIT', 1000); //regular body text limit in main search

define('SS_DELTA_INDEX', 'delta'); //there is still a prefix
define('SS_MAIN_INDEX', 'main');
define('SS_STATS_INDEX', 'stats');

/**
 *
 * Collection of attributes that come from sphinx.conf
 *
 */
//individual index names - rotate these by themselves
define ('SS_INDEX_MAIN',C('Plugin.SphinxSearchLite.Prefix', 'vss_').'main');
define ('SS_INDEX_DELTA',C('Plugin.SphinxSearchLite.Prefix', 'vss_').'delta');
define ('SS_INDEX_STATS',C('Plugin.SphinxSearchLite.Prefix', 'vss_').'stats');

//distributed index - search against this, but don't update this on itself
define ('SS_INDEX_DIST','vanilla');

//These are ONLY indexed
define ('SS_FIELD_BODY','body');
define ('SS_FIELD_TITLE','title');
define ('SS_FIELD_USERNAME','user');

//these are ONLY stored
define ('SS_ATTR_DOCID','docid');
define ('SS_ATTR_CATPERMID','catpermid');
define ('SS_ATTR_ISCOMMENT','iscomment');
define ('SS_ATTR_DOCDATEINSERTED','docdateinserted');
define ('SS_ATTR_COUNTVIEWS','countviews');
define ('SS_ATTR_COUNTCOMENTS','countcomments');
define ('SS_ATTR_CATID','catid');
define ('SS_ATTR_USERPHOTO','userphoto');
define ('SS_ATTR_USERID','userid');
