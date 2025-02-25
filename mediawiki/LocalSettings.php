<?php
error_reporting(E_ALL ^ E_DEPRECATED);

# This file was automatically generated by the MediaWiki 1.41.0
# installer. If you make manual changes, please keep track in case you
# need to recreate them later.
#
# See includes/MainConfigSchema.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = "Mapa movimentos";
$wgMetaNamespace = "MapaMovSaude";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "";

## The protocol and server name to use in fully-qualified URLs
$wgServer = getenv('WG_SERVER');

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

## The URL paths to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogos = [
	'1x' => "$wgResourceBasePath/themes/images/logo_white.png",
	'icon' => "$wgResourceBasePath/resources/assets/change-your-logo-icon.svg",
];

## UPO means: this is also a user preference option

$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = "";

$wgEnotifUserTalk = true; # UPO
$wgEnotifWatchlist = true; # UPO
$wgEmailAuthentication = true;

## Database settings
$wgDBtype = getenv('WG_DB_TYPE');
$wgDBserver = getenv('WG_DB_SERVER');
$wgDBname = getenv('WG_DB_NAME');
$wgDBuser = getenv('WG_DB_USER');
$wgDBpassword = getenv('WG_DB_PASSWORD');

# MySQL specific settings
$wgDBprefix = "";
$wgDBssl = false;

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Shared database table
# This has no effect unless $wgSharedDB is also set.
$wgSharedTables[] = "actor";

## Shared memory settings
$wgMainCacheType = CACHE_NONE;
$wgMemCachedServers = [];

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
$wgUseCopyrightUpload = true;
#$wgUseImageMagick = true;
#$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = true;

# Periodically send a pingback to https://www.mediawiki.org/ with basic data
# about this MediaWiki instance. The Wikimedia Foundation shares this data
# with MediaWiki developers to help guide future development efforts.
$wgPingback = false;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale. This should ideally be set to an English
## language locale so that the behaviour of C library functions will
## be consistent with typical installations. Use $wgLanguageCode to
## localise the wiki.
$wgShellLocale = "C.UTF-8";
# Site language code, should be one of the list in ./includes/languages/data/Names.php
$wgLanguageCode = "pt-br";

# Time zone
$wgLocaltimezone = "America/Sao_Paulo";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publicly accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/data/Names.php
$wgLanguageCode = "pt-br";

$wgSecretKey = getenv('WG_SECRET_KEY');

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = getenv('WG_UPGRADE_KEY');

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = "Mapa Colaborativo dos Movimentos Sociais em Saúde"; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "https://creativecommons.org/licenses/by-sa/4.0/";
$wgRightsText = "Creative Commons - Atribuição - Compartilhamento pela mesma Licença";
$wgRightsIcon = "$wgResourceBasePath/resources/assets/licenses/cc-by-sa.png";


# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# The following permissions were set based on your choice in the installer
#$wgGroupPermissions['*']['createaccount'] = false;

## Default skin: you can change the default skin. Use the internal symbolic
## names, e.g. 'vector' or 'monobook':
$wgDefaultSkin = "vector-2022";

# Enabled skins.
# The following skins were automatically enabled:
wfLoadSkin( 'Vector' );
#wfLoadSkin( 'MonoBook' );
#wfLoadSkin( 'Timeless' );

# Enabled extensions. Most of the extensions are enabled by adding
# wfLoadExtension( 'ExtensionName' );
# to LocalSettings.php. Check specific extension documentation for more details.
# The following extensions were automatically enabled:
wfLoadExtension( 'CategoryTree' );
wfLoadExtension( 'Cite' );
wfLoadExtension( 'CiteThisPage' );
wfLoadExtension( 'CodeEditor' );
wfLoadExtension( 'ConfirmEdit' );
wfLoadExtension( 'Gadgets' );
wfLoadExtension( 'ImageMap' );
wfLoadExtension( 'InputBox' );
wfLoadExtension( 'Interwiki' );
wfLoadExtension( 'MultimediaViewer' );
wfLoadExtension( 'Nuke' );
wfLoadExtension( 'OATHAuth' );
wfLoadExtension( 'PageImages' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'PdfHandler' );
wfLoadExtension( 'Poem' );
wfLoadExtension( 'ReplaceText' );
wfLoadExtension( 'Scribunto' );
wfLoadExtension( 'SecureLinkFixer' );
wfLoadExtension( 'SpamBlacklist' );
wfLoadExtension( 'TextExtracts' );
wfLoadExtension( 'TitleBlacklist' );
wfLoadExtension( 'WikiEditor');

# End of automatically generated settings.
# Add more configuration options below.
wfLoadExtension( 'EmbedVideo' );
wfLoadExtension( 'FontAwesome' );
wfLoadExtension( 'GeoData' );

wfLoadExtension( 'PageForms' );


#Extensões extras
wfLoadExtension( 'ArticleRatings' );
wfLoadExtension( 'Disambiguator' );
wfLoadExtension( 'HeadScript' );
wfLoadExtension( 'HitCounters' );
wfLoadExtension( 'Iframe' );
wfLoadExtension( 'InteractiveTimeline' );
wfLoadExtension( 'JsonConfig' );
wfLoadExtension( 'PDFembed' );
#wfLoadExtension( 'Renameuser' );
wfLoadExtension( 'TemplateData' );
wfLoadExtension( 'Timeline' );
wfLoadExtension( 'UserExport' );
wfLoadExtension( 'WikiCategoryTagCloud' );
wfLoadExtension( 'WikiSEO' );

wfLoadExtension( 'NoTitle' );
$wgRestrictDisplayTitle = false;

# Visual Editor
wfLoadExtension( 'VisualEditor' );
$wgGroupPermissions['user']['writeapi'] = true;
$wgVisualEditorSupportedSkins = ['*'];
$wgUsePathInfo = true;

# Ativar o VisualEditor em todos os namespaces
$wgVisualEditorAvailableNamespaces = array(
	NS_USER => true,
	NS_HELP => true,
	NS_PROJECT => true
);
# Transclusão de seção
wfLoadExtension( 'LabeledSectionTransclusion' );

#Destaques com RandomSelection
wfLoadExtension( 'RandomSelection' );

#Destaques com RandomPages
wfLoadExtension( 'RandomPages' );

#Easy Timeline
$wgTimelineFontFile = 'ascii';
#Bootstrap
wfLoadExtension( 'Bootstrap' );

# LAYOUT
// Configurar Bootstrap
$wgHooks['SetupAfterCache'][] = function(){
	\Bootstrap\BootstrapManager::getInstance()->addAllBootstrapModules();
	return true;
};

$wgHooks['ParserAfterParse'][]=function( Parser &$parser, &$text, StripState &$stripState ){
	$parser->getOutput()->addModuleStyles( ['ext.bootstrap.styles'] );
	$parser->getOutput()->addModules( ['ext.bootstrap.scripts'] );
	return true;
};

#Bootstrap Components
wfLoadExtension( 'BootstrapComponents' );
$wgBootstrapComponentsWhitelist = true;
$wgBootstrapComponentsEnableCarouselGalleryMode = true;

// Ativar Skins alternativa com Mobile Frontend
#wfLoadExtension( 'MobileFrontend' );
wfLoadSkin( 'MinervaNeue' );
#$wgMFDefaultSkinClass = 'SkinMinerva';

// Ativa o Chameleon e define como skin padrão
wfLoadSkin( 'chameleon' );
$wgDefaultSkin = 'chameleon';

// Definir layout Chameleon com navegação fixa para todo o site
$egChameleonLayoutFile= '/var/www/mediawiki/skins/chameleon/layouts/fixedhead.xml';

// Custom Chameleon bootstrap theme
$egChameleonThemeFile = '/var/www/mediawiki/themes/journal/_variables.scss';
$egChameleonExternalStyleModules = [
	'/var/www/mediawiki/themes/journal/_bootswatch.scss' => 'afterMain',

];

// Definir as esquema de estilos via variáveis do Chameleon
$egChameleonExternalStyleVariables = [
	'$body-bg' => '#f4f6f9',
	'$cmln-navbar-bg-color' => 'dark',
	'$cmln-navbar-toggler-color' => 'light',
	'$cmln-search-bar-btn-color' => 'dark',
	'$cmln-personal-tools-link-new' =>	'("color": #FFF, "hover-color": #FFF)',
	'$cmln-navbar-logo-height' => '2.3rem',
	'$component-active-bg' => '#F27405',
	'$theme-colors' => '("primary": #62259c, "secondary": #6c757d, "success": #28a745, "info": #17a2b8, "warning": #ffc107, "danger": #dc3545, "light": #e9ecef, "dark": #1450AA, "error": #dc3545, "darker": #ced4da)',
	'$cmln-link-formats' => "(new: ('color': #6E6E6E, 'hover-color': #FFA700 underline), stub: #f31d6c none #FF0089 underline,  extiw: #6B0CBC none #B607D6 underline, external:  #C7064E none #F7005C underline)",
	'$navbar-light-color' => '#FFF',
	'$navbar-light-hover-color' => '#ABBAF4',
	'$navbar-light-active-color' => '#FFF',
	'$enable-gradients' => '1',
];

// Enable external link icons
$egChameleonEnableExternalLinkIcons = true;

# Define the URL path of the shortcut icon.
$wgFavicon = '/themes/images/favicon.ico';

# DisplayTitle
$wgAllowDisplayTitle = true;
$wgRestrictDisplayTitle = false;

# Configuracoes comportamento links externos;
$wgExternalLinkTarget = '_blank';

# Configuracoes comportamento de Categorias
$wgCategoryMagicGallery = true;
$wgCategoryCollation = 'numeric';

# Habilitar palavra magica
$wgAllowSlowParserFunctions = true;

# Configuracoes de e-mail
$wgSMTP = array(
	'host' => getenv('WG_SMTP_HOST'),
	'IDHost' => getenv('WG_SMTP_IDHOST'),
	'port' => getenv('WG_SMTP_PORT'),
	'localhost' => getenv('WG_SMTP_LOCALHOST'),
	'username' => getenv('WG_SMTP_USERNAME'),
	'password' => getenv('WG_SMTP_PASSWORD'),
	'auth' => (bool) getenv('WG_SMTP_AUTH'),
);
// E-mail do FROM para envio de emails
$wgPasswordSender = getenv('WG_SMTP_USERNAME');

# Tornar email obrigatorio
$wgEmailConfirmToEdit = true;
//$wgEmailAuthentication = true; //Defina como true para ativar a autenticação por correio eletrónico (confirmação) para esta wiki
//$wgAllowRequiringEmailForResets = true; //Temporary feature flag that controls whether users will see a checkbox allowing them to require providing email during password resets.


# Enviar email de paginas vigiadas
$wgEnotifWatchlist = true;

# The permissions
$wgGroupPermissions['*']['edit'] = false;
# Ativar para Oficinas
$wgGroupPermissions['user']['noratelimit'] = true;
# Limite de criação de contas por IP
$wgAccountCreationThrottle = 40;

# Configuracoes do UserExport
$wgGroupPermissions['sysop']['userexport'] = true;
# https://www.mediawiki.org/wiki/Manual:Renameuser
$wgGroupPermissions['sysop']['renameuser'] = true;


# For SVG image support
$wgFileExtensions = array_merge(
    $wgFileExtensions, [
        'pdf', 'svg'
    ]
);

$wgAllowTitlesInSVG = true;

# Exibir vídeos
$wgEmbedVideoAddFileExtensions = true;
$wgEmbedVideoEnableVideoHandler = true;
$wgEmbedVideoEnableAudioHandler = true;
# Realtime Preview
$wgWikiEditorRealtimePreview = true;

# Configuracoes de PDF
// Default width for the PDF object container.
$wgPdfEmbed['width'] = 800;
// Default height for the PDF object container.
$wgPdfEmbed['height'] = 1090;
//Allow user the usage of the pdf tag
$wgGroupPermissions['*']['embed_pdf'] = true;

# Configuracoes de IFrame
$wgIframe['category'] = 'Iframe';
#$wgIframe['width'] = 800;
#$wgIframe['height'] = 600;
$wgIframe['server']['google'] = [ 'scheme' => 'https', 'domain' => 'www.google.com' ];
$wgIframe['server']['youtube'] = [ 'scheme' => 'https', 'domain' => 'www.youtube.com' ];
$wgIframe['server']['fiocruz'] = [ 'scheme' => 'https', 'domain' => 'faleconosco.fiocruz.br' ];
$wgIframe['server']['openstreetmap'] = [ 'scheme' => 'https', 'domain' => 'www.openstreetmap.org' ];
$wgIframe['server']['googledocs'] = [ 'scheme' => 'https',  'domain' => 'docs.google.com'];
$wgIframe['server']['arcgis'] = [ 'scheme' => 'https',  'domain' => 'www.arcgis.com'];
$wgIframe['server']['mss'] = [ 'scheme' => 'https',  'domain' => 'movimentossociaisemsaude.net.br'];
#$wgIframe['server']['mailchimp'] = [ 'scheme' => 'https', 'domain' => 'mailchi.mp' ];

# Kartographer
wfLoadExtension( 'Kartographer' );
$wgKartographerMapServer = 'https://tile.openstreetmap.org';
$wgKartographerMapServer = 'https://tileserver.map.as';
$wgKartographerStyles = ['osm'];
$wgKartographerDfltStyle = '';
$wgKartographerSimpleStyleMarkers = false;

# CSS
wfLoadExtension( 'Css' );

# PopUps
wfLoadExtension( 'Popups' );

#DynamicPageList
wfLoadExtension( 'Intersection' );
# Configuration variables. Warning: These use DLP instead of DPL
# for historical reasons (pretend Dynamic list of pages)
$wgDLPmaxCategories = 6;                // Maximum number of categories to look for
$wgDLPMaxResultCount = 1500;             // Maximum number of results to allow
$wgDLPAllowUnlimitedResults = true;    // Allow unlimited results
$wgDLPAllowUnlimitedCategories = true; // Allow unlimited categories
// How long to cache pages using DPL's in seconds. Default to 1 day. Set to
// false to use the normal amount of page caching (most efficient), Set to 0 to disable
// cache altogether (inefficient, but results will never be outdated)
$wgDLPMaxCacheTime = 60*60*24;          // How long to cache pages in seconds

#Suprime aviso do EmbedVideo de funções deprecadas do PHP
$wgDeprecationReleaseLimit = '1.0';

# Configurar references
$wgCiteBookReferencing = true;
$wgCiteResponsiveReferences = true;


#Creditos aos colaboradores
wfLoadExtension( 'CreditsSource' );


#wfLoadExtension( 'ArticleFeedback');
#$wgArticleFeedbackv5Namespaces = array( NS_MAIN, NS_HELP );

#wfLoadExtension( 'BannerAds' );
#wfLoadExtension( 'Collection' );

#Log de Eventos
#wfLoadExtension( 'EventLogging' );
#$wgEventLoggingBaseUri = '/beacon/event';
#$wgEventLoggingSchemaApiUri = $wgServer . '/api.php';
#$wgEventLoggingDBname = $wgDBname;

#Colaboration Kit (Depente do log de eventos)
#wfLoadExtension( 'CollaborationKit' );

#Guided Tour (Depende do log de eventos)
#wfLoadExtension( 'GuidedTour' );

wfLoadExtension( 'SyntaxHighlight_GeSHi' );
wfLoadExtension( 'AbuseFilter' );

# Para ativar o Modo Debug use true
$wgShowDebug = false;
$wgDevelopmentWarnings = false;
$wgShowExceptionDetails = false;

