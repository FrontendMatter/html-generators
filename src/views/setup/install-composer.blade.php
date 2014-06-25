@extends("html-generators::layouts.docs")

@section('content')
<h1>Introduction</h1>

<p>Composer is a tool for dependency management in PHP. It allows you to declare
    the dependent libraries your project needs and it will install them in your
    project for you.</p>

<h2>
    <a name="user-content-dependency-management" class="anchor" href="#dependency-management" aria-hidden="true"><span class="octicon octicon-link"></span></a>Dependency management</h2>

<p>Composer is not a package manager. Yes, it deals with "packages" or libraries, but
    it manages them on a per-project basis, installing them in a directory (e.g. <code>vendor</code>)
    inside your project. By default it will never install anything globally. Thus,
    it is a dependency manager.</p>

<p>This idea is not new and Composer is strongly inspired by node's <a href="http://npmjs.org/">npm</a>
    and ruby's <a href="http://gembundler.com/">bundler</a>. But there has not been such a tool
    for PHP.</p>

<p>The problem that Composer solves is this:</p>

<p>a) You have a project that depends on a number of libraries.</p>

<p>b) Some of those libraries depend on other libraries.</p>

<p>c) You declare the things you depend on.</p>

<p>d) Composer finds out which versions of which packages need to be installed, and
    installs them (meaning it downloads them into your project).</p>

<h2>
    <a name="user-content-declaring-dependencies" class="anchor" href="#declaring-dependencies" aria-hidden="true"><span class="octicon octicon-link"></span></a>Declaring dependencies</h2>

<p>Let's say you are creating a project, and you need a library that does logging.
    You decide to use <a href="https://github.com/Seldaek/monolog">monolog</a>. In order to
    add it to your project, all you need to do is create a <code>composer.json</code> file
    which describes the project's dependencies.</p>

<div class="highlight highlight-json"><pre><span class="p">{</span>
<span class="nt">"require"</span><span class="p">:</span> <span class="p">{</span>
    <span class="nt">"monolog/monolog"</span><span class="p">:</span> <span class="s2">"1.2.*"</span>
<span class="p">}</span>
<span class="p">}</span>
</pre></div>

<p>We are simply stating that our project requires some <code>monolog/monolog</code> package,
    any version beginning with <code>1.2</code>.</p>

<h2>
    <a name="user-content-system-requirements" class="anchor" href="#system-requirements" aria-hidden="true"><span class="octicon octicon-link"></span></a>System Requirements</h2>

<p>Composer requires PHP 5.3.2+ to run. A few sensitive php settings and compile
    flags are also required, but the installer will warn you about any
    incompatibilities.</p>

<p>To install packages from sources instead of simple zip archives, you will need
    git, svn or hg depending on how the package is version-controlled.</p>

<p>Composer is multi-platform and we strive to make it run equally well on Windows,
    Linux and OSX.</p>

<h2>
    <a name="user-content-installation---nix" class="anchor" href="#installation---nix" aria-hidden="true"><span class="octicon octicon-link"></span></a>Installation - *nix</h2>

<h3>
    <a name="user-content-downloading-the-composer-executable" class="anchor" href="#downloading-the-composer-executable" aria-hidden="true"><span class="octicon octicon-link"></span></a>Downloading the Composer Executable</h3>

<h4>
    <a name="user-content-locally" class="anchor" href="#locally" aria-hidden="true"><span class="octicon octicon-link"></span></a>Locally</h4>

<p>To actually get Composer, we need to do two things. The first one is installing
    Composer (again, this means downloading it into your project):</p>

<div class="highlight highlight-sh"><pre>curl -sS https://getcomposer.org/installer <span class="p">|</span> php
</pre></div>

<blockquote>
    <p><strong>Note:</strong> If the above fails for some reason, you can download the installer
        with <code>php</code> instead:</p>
</blockquote>

<div class="highlight highlight-sh"><pre>php -r <span class="s2">"readfile('https://getcomposer.org/installer');"</span> <span class="p">|</span> php
</pre></div>

<p>This will just check a few PHP settings and then download <code>composer.phar</code> to
    your working directory. This file is the Composer binary. It is a PHAR (PHP
    archive), which is an archive format for PHP which can be run on the command
    line, amongst other things.</p>

<p>You can install Composer to a specific directory by using the <code>--install-dir</code>
    option and providing a target directory (it can be an absolute or relative path):</p>

<div class="highlight highlight-sh"><pre>curl -sS https://getcomposer.org/installer <span class="p">|</span> php -- --install-dir<span class="o">=</span>bin
</pre></div>

<h4>
    <a name="user-content-globally" class="anchor" href="#globally" aria-hidden="true"><span class="octicon octicon-link"></span></a>Globally</h4>

<p>You can place this file anywhere you wish. If you put it in your <code>PATH</code>,
    you can access it globally. On unixy systems you can even make it
    executable and invoke it without <code>php</code>.</p>

<p>You can run these commands to easily access <code>composer</code> from anywhere on your system:</p>

<div class="highlight highlight-sh"><pre>curl -sS https://getcomposer.org/installer <span class="p">|</span> php
mv composer.phar /usr/local/bin/composer
</pre></div>

<blockquote>
    <p><strong>Note:</strong> If the above fails due to permissions, run the <code>mv</code> line
        again with sudo.</p>
</blockquote>

<p>Then, just run <code>composer</code> in order to run Composer instead of <code>php composer.phar</code>.</p>

<h4>
    <a name="user-content-globally-on-osx-via-homebrew" class="anchor" href="#globally-on-osx-via-homebrew" aria-hidden="true"><span class="octicon octicon-link"></span></a>Globally (on OSX via homebrew)</h4>

<p>Composer is part of the homebrew-php project.</p>

<div class="highlight highlight-sh"><pre>brew update
brew tap homebrew/homebrew-php
brew tap homebrew/dupes
brew tap homebrew/versions
brew install php55-intl
brew install homebrew/php/composer
</pre></div>

<h2>
    <a name="user-content-installation---windows" class="anchor" href="#installation---windows" aria-hidden="true"><span class="octicon octicon-link"></span></a>Installation - Windows</h2>

<h3>
    <a name="user-content-using-the-installer" class="anchor" href="#using-the-installer" aria-hidden="true"><span class="octicon octicon-link"></span></a>Using the Installer</h3>

<p>This is the easiest way to get Composer set up on your machine.</p>

<p>Download and run <a href="https://getcomposer.org/Composer-Setup.exe">Composer-Setup.exe</a>,
    it will install the latest Composer version and set up your PATH so that you can
    just call <code>composer</code> from any directory in your command line.</p>

<h3>
    <a name="user-content-manual-installation" class="anchor" href="#manual-installation" aria-hidden="true"><span class="octicon octicon-link"></span></a>Manual Installation</h3>

<p>Change to a directory on your <code>PATH</code> and run the install snippet to download
    composer.phar:</p>

<div class="highlight highlight-sh"><pre>C:<span class="se">\U</span>sers<span class="se">\u</span>sername&gt;cd C:<span class="se">\b</span>in
C:<span class="se">\b</span>in&gt;php -r <span class="s2">"readfile('https://getcomposer.org/installer');"</span> <span class="p">|</span> php
</pre></div>

<blockquote>
    <p><strong>Note:</strong> If the above fails due to readfile, use the <code>http</code> url or enable php_openssl.dll in php.ini</p>
</blockquote>

<p>Create a new <code>composer.bat</code> file alongside <code>composer.phar</code>:</p>

<div class="highlight highlight-sh"><pre>C:<span class="se">\b</span>in&gt;echo @php <span class="s2">"%~dp0composer.phar"</span> %*&gt;composer.bat
</pre></div>

<p>Close your current terminal. Test usage with a new terminal:</p>

<div class="highlight highlight-sh"><pre>C:<span class="se">\U</span>sers<span class="se">\u</span>sername&gt;composer -V
Composer version 27d8904
</pre></div>

<h2>
    <a name="user-content-using-composer" class="anchor" href="#using-composer" aria-hidden="true"><span class="octicon octicon-link"></span></a>Using Composer</h2>

<p>We will now use Composer to install the dependencies of the project. If you
    don't have a <code>composer.json</code> file in the current directory please skip to the
    <a href="/composer/composer/blob/master/doc/01-basic-usage.md">Basic Usage</a> chapter.</p>

<p>To resolve and download dependencies, run the <code>install</code> command:</p>

<div class="highlight highlight-sh"><pre>php composer.phar install
</pre></div>

<p>If you did a global install and do not have the phar in that directory
    run this instead:</p>

<div class="highlight highlight-sh"><pre>composer install
</pre></div>

<p>Following the <a href="#declaring-dependencies">example above</a>, this will download
    monolog into the <code>vendor/monolog/monolog</code> directory.</p>

<h2>
    <a name="user-content-autoloading" class="anchor" href="#autoloading" aria-hidden="true"><span class="octicon octicon-link"></span></a>Autoloading</h2>

<p>Besides downloading the library, Composer also prepares an autoload file that's
    capable of autoloading all of the classes in any of the libraries that it
    downloads. To use it, just add the following line to your code's bootstrap
    process:</p>

<div class="highlight highlight-php"><pre><span class="k">require</span> <span class="s1">'vendor/autoload.php'</span><span class="p">;</span>
</pre></div>

<p>Woah! Now start using monolog! To keep learning more about Composer, keep
    reading the "Basic Usage" chapter.</p>

<p><a href="/composer/composer/blob/master/doc/01-basic-usage.md">Basic Usage</a> →</p>
@stop