@extends('html-generators::layouts.docs')

@section('content')

<h1>Bootstrap 3 HTML Generators for Laravel 4</h1>
<p class="lead text-muted">Setup and Installation</p>
<hr/>


<blockquote>
    <p><strong>Prerequisites</strong>: Composer, PHP &gt;=5.4, Laravel 4.2.*</p>
</blockquote>
<h3>1. Create a new Laravel project</h3>
<div>
    <pre>composer create-project laravel/laravel my-project</pre>
</div>


<h3>2. Prepare the downloaded ZIP package</h3>
<blockquote>
    <p>Because we're using Composer to install the package and in this case there is no ability to have an online VCS repository for Composer
        to download the package from, we'll be using an "artifact" or local ZIP repository. Note: the package for Laravel is not the actual ZIP file
        that you downloaded from CodeCanyon, but another ZIP file placed within the main archive: <strong>laravel/mosaicpro-html-generators-1.0.0.zip</strong>.</p>
</blockquote>
<div>
<pre>cd my-project
mkdir mosaicpro-packages
cp /path/to/downloaded/mosaicpro-html-generators-1.0.0.zip mosaicpro-packages/</pre></div>


<h3 id="markdown-header-3-update-laravels-composerjson">3. Update Laravel's composer.json</h3>
<blockquote>
    <p>We need to instruct Composer to use the artifact ZIP file as the source for our package, so open up your favourite text editor
        (such as VIM) and edit the project's composer.json file to include the following:</p>
</blockquote>
<div class="codehilite"><pre><span class="s2">"repositories"</span><span class="o">:</span><span class="w"> </span><span class="p">[</span>
<span class="w">    </span><span class="p">{</span>
<span class="w">        </span><span class="s2">"type"</span><span class="o">:</span><span class="w"> </span><span class="s2">"artifact"</span><span class="p">,</span>
<span class="w">        </span><span class="s2">"url"</span><span class="o">:</span><span class="w"> </span><span class="s2">"mosaicpro-packages/"</span>
<span class="w">    </span><span class="p">}</span>
<span class="p">],</span>
</pre></div>


<blockquote>
    <p><strong>Note</strong>: If the "repositories" is the last key within the JSON structure, make sure to remove the last comma above;</p>
</blockquote>
<h3 id="markdown-header-4-install-the-html-markup-generators">4. Install the HTML Markup Generators</h3>
<div class="codehilite"><pre><span class="vg">composer</span><span class="w"> </span><span class="vg">require</span><span class="w"> </span><span class="vg">mosaicpro</span><span class="o">/</span><span class="vg">html</span><span class="o">-</span><span class="nl">generators:</span><span class="o">*</span>
</pre></div>


<h3 id="markdown-header-5-register-the-service-provider">5. Register the service provider</h3>
<p>Add the following to the <code>providers</code> list in the <code>app/config/app.php</code> file:</p>
<div class="codehilite"><pre><span class="c1">'providers' =&gt; array(</span>
<span class="w">    </span><span class="o">...</span>
<span class="w">    </span><span class="c1">'ThemeKit\HtmlGenerators\HtmlGeneratorsServiceProvider',</span>
<span class="p">),</span>
</pre></div>


<h3 id="markdown-header-6-publish-the-assets-public">6. Publish the assets (public)</h3>
<div class="codehilite"><pre><span class="vg">php</span><span class="w"> </span><span class="vg">artisan</span><span class="w"> </span><span class="nl">asset:</span><span class="vg">publish</span><span class="w"> </span><span class="vg">mosaicpro</span><span class="o">/</span><span class="vg">html</span><span class="o">-</span><span class="vg">generators</span>
</pre></div>


<h3 id="markdown-header-7-have-fun">7. Have fun</h3>
<blockquote>
    <p>You should now be able to open your new Laravel project in your browser and check out the examples at
        <a href="http://localhost/path/to/your/laravel/install/html-generators/accordion"></a><a href="http://localhost/path/to/your/laravel/install/html-generators/accordion" rel="nofollow">http://localhost/path/to/your/laravel/install/html-generators/accordion</a></p>
</blockquote>

@endsection