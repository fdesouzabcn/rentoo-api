<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.6.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.6.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-register">
                                <a href="#authentication-POSTapi-v1-register">Register a new user.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-login">
                                <a href="#authentication-POSTapi-v1-login">Login a user.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-logout">
                                <a href="#authentication-POSTapi-v1-logout">Logout the authenticated user.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-contracts" class="tocify-header">
                <li class="tocify-item level-1" data-unique="contracts">
                    <a href="#contracts">Contracts</a>
                </li>
                                    <ul id="tocify-subheader-contracts" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="contracts-POSTapi-v1-contracts">
                                <a href="#contracts-POSTapi-v1-contracts">Create a new contract.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="contracts-GETapi-v1-contracts">
                                <a href="#contracts-GETapi-v1-contracts">List all contracts.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="contracts-GETapi-v1-contracts--uuid-">
                                <a href="#contracts-GETapi-v1-contracts--uuid-">Show a specific contract.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="contracts-PUTapi-v1-contracts--uuid-">
                                <a href="#contracts-PUTapi-v1-contracts--uuid-">Update a contract.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="contracts-DELETEapi-v1-contracts--uuid-">
                                <a href="#contracts-DELETEapi-v1-contracts--uuid-">Delete a contract (soft delete).</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-properties" class="tocify-header">
                <li class="tocify-item level-1" data-unique="properties">
                    <a href="#properties">Properties</a>
                </li>
                                    <ul id="tocify-subheader-properties" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="properties-POSTapi-v1-properties">
                                <a href="#properties-POSTapi-v1-properties">Create a new property.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="properties-GETapi-v1-properties">
                                <a href="#properties-GETapi-v1-properties">List all properties.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="properties-GETapi-v1-properties--uuid-">
                                <a href="#properties-GETapi-v1-properties--uuid-">Show a specific property.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="properties-PUTapi-v1-properties--uuid-">
                                <a href="#properties-PUTapi-v1-properties--uuid-">Update a property.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="properties-DELETEapi-v1-properties--uuid-">
                                <a href="#properties-DELETEapi-v1-properties--uuid-">Delete a property (soft delete).</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-users" class="tocify-header">
                <li class="tocify-item level-1" data-unique="users">
                    <a href="#users">Users</a>
                </li>
                                    <ul id="tocify-subheader-users" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="users-GETapi-v1-users">
                                <a href="#users-GETapi-v1-users">List all users.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="users-GETapi-v1-users--uuid-">
                                <a href="#users-GETapi-v1-users--uuid-">Show a specific user.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="users-DELETEapi-v1-users--uuid-">
                                <a href="#users-DELETEapi-v1-users--uuid-">Delete a user (soft delete).</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: February 27, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="authentication">Authentication</h1>

    

                                <h2 id="authentication-POSTapi-v1-register">Register a new user.</h2>

<p>
</p>

<p>Creates a new property owner account and returns an access token.
The new user is automatically assigned the &quot;User&quot; role.</p>

<span id="example-requests-POSTapi-v1-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"New Owner\",
    \"dni\": \"12345678A\",
    \"email\": \"newowner@rentoo.com\",
    \"phone\": \"600111222\",
    \"address\": \"Carrer de Balmes, 10\",
    \"city\": \"Barcelona\",
    \"postal_code\": \"08007\",
    \"province\": \"Barcelona\",
    \"password\": \"password\",
    \"password_confirmation\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "New Owner",
    "dni": "12345678A",
    "email": "newowner@rentoo.com",
    "phone": "600111222",
    "address": "Carrer de Balmes, 10",
    "city": "Barcelona",
    "postal_code": "08007",
    "province": "Barcelona",
    "password": "password",
    "password_confirmation": "password"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-register">
            <blockquote>
            <p>Example response (201, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;uuid-here&quot;,
        &quot;name&quot;: &quot;New Owner&quot;,
        &quot;email&quot;: &quot;newowner@rentoo.com&quot;
    },
    &quot;token&quot;: &quot;access-token-here&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The email has already been taken.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The email has already been taken.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-register" data-method="POST"
      data-path="api/v1/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-register"
                    onclick="tryItOut('POSTapi-v1-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-register"
                    onclick="cancelTryOut('POSTapi-v1-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-register"
               value="New Owner"
               data-component="body">
    <br>
<p>Full name of the owner. Example: <code>New Owner</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>dni</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="dni"                data-endpoint="POSTapi-v1-register"
               value="12345678A"
               data-component="body">
    <br>
<p>Spanish DNI or NIE (unique). Example: <code>12345678A</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-register"
               value="newowner@rentoo.com"
               data-component="body">
    <br>
<p>Email address (unique). Example: <code>newowner@rentoo.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-v1-register"
               value="600111222"
               data-component="body">
    <br>
<p>Contact phone number. Example: <code>600111222</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-v1-register"
               value="Carrer de Balmes, 10"
               data-component="body">
    <br>
<p>Street address. Example: <code>Carrer de Balmes, 10</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="POSTapi-v1-register"
               value="Barcelona"
               data-component="body">
    <br>
<p>City. Example: <code>Barcelona</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>postal_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="postal_code"                data-endpoint="POSTapi-v1-register"
               value="08007"
               data-component="body">
    <br>
<p>Postal code. Example: <code>08007</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>province</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="province"                data-endpoint="POSTapi-v1-register"
               value="Barcelona"
               data-component="body">
    <br>
<p>Province. Example: <code>Barcelona</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-register"
               value="password"
               data-component="body">
    <br>
<p>Password (min 8 characters). Example: <code>password</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-v1-register"
               value="password"
               data-component="body">
    <br>
<p>Must match password. Example: <code>password</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-login">Login a user.</h2>

<p>
</p>

<p>Authenticates the user with email and password and returns an access token.</p>

<span id="example-requests-POSTapi-v1-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"owner@rentoo.com\",
    \"password\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "owner@rentoo.com",
    "password": "password"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-login">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;uuid-here&quot;,
        &quot;name&quot;: &quot;Owner Name&quot;,
        &quot;email&quot;: &quot;owner@rentoo.com&quot;
    },
    &quot;token&quot;: &quot;access-token-here&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, invalid credentials):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invalid credentials&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The email field is required.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The email field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-login" data-method="POST"
      data-path="api/v1/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-login"
                    onclick="tryItOut('POSTapi-v1-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-login"
                    onclick="cancelTryOut('POSTapi-v1-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-login"
               value="owner@rentoo.com"
               data-component="body">
    <br>
<p>Registered email address. Example: <code>owner@rentoo.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-login"
               value="password"
               data-component="body">
    <br>
<p>Account password. Example: <code>password</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-logout">Logout the authenticated user.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Revokes the current access token, ending the API session.</p>

<span id="example-requests-POSTapi-v1-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-logout">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Successfully logged out&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-logout" data-method="POST"
      data-path="api/v1/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-logout"
                    onclick="tryItOut('POSTapi-v1-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-logout"
                    onclick="cancelTryOut('POSTapi-v1-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="contracts">Contracts</h1>

    

                                <h2 id="contracts-POSTapi-v1-contracts">Create a new contract.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Creates a contract for a given property. Admins can create contracts
on any property. Regular users can only create contracts on their own properties.</p>

<span id="example-requests-POSTapi-v1-contracts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/contracts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"property_id\": \"9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e\",
    \"status\": \"draft\",
    \"start_date\": \"2026-03-01\",
    \"end_date\": \"2027-03-01\",
    \"monthly_rent\": 1200,
    \"legal_deposit\": 1200,
    \"additional_deposit\": 1200,
    \"tenant_pays_ibi\": false,
    \"tenant_pays_community_fees\": false,
    \"tenant_pays_garbage_fees\": false,
    \"irpa_value\": 1260,
    \"is_tensioned_area\": false,
    \"tenant1_name\": \"Joan Puigdemon\",
    \"tenant1_dni\": \"12345678A\",
    \"tenant1_email\": \"\\\"joan@rentoo.com\\\"\",
    \"tenant1_phone\": \"600111222\",
    \"tenant2_name\": \"Maria Garcia\",
    \"tenant2_dni\": \"87654321B\",
    \"tenant2_email\": \"maria@rentoo.com\\\"\",
    \"tenant2_phone\": \"600222333\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/contracts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "property_id": "9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e",
    "status": "draft",
    "start_date": "2026-03-01",
    "end_date": "2027-03-01",
    "monthly_rent": 1200,
    "legal_deposit": 1200,
    "additional_deposit": 1200,
    "tenant_pays_ibi": false,
    "tenant_pays_community_fees": false,
    "tenant_pays_garbage_fees": false,
    "irpa_value": 1260,
    "is_tensioned_area": false,
    "tenant1_name": "Joan Puigdemon",
    "tenant1_dni": "12345678A",
    "tenant1_email": "\"joan@rentoo.com\"",
    "tenant1_phone": "600111222",
    "tenant2_name": "Maria Garcia",
    "tenant2_dni": "87654321B",
    "tenant2_email": "maria@rentoo.com\"",
    "tenant2_phone": "600222333"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-contracts">
            <blockquote>
            <p>Example response (201, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;uuid&quot;,
        &quot;property_id&quot;: &quot;uuid&quot;,
        &quot;status&quot;: &quot;draft&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The property_id field is required.&quot;,
    &quot;errors&quot;: {}
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-contracts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-contracts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-contracts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-contracts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-contracts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-contracts" data-method="POST"
      data-path="api/v1/contracts"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-contracts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-contracts"
                    onclick="tryItOut('POSTapi-v1-contracts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-contracts"
                    onclick="cancelTryOut('POSTapi-v1-contracts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-contracts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/contracts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-contracts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-contracts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>property_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="property_id"                data-endpoint="POSTapi-v1-contracts"
               value="9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
               data-component="body">
    <br>
<p>UUID of the property. Example: <code>9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-v1-contracts"
               value="draft"
               data-component="body">
    <br>
<p>Contract status: draft, active, or finalized. Example: <code>draft</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_date"                data-endpoint="POSTapi-v1-contracts"
               value="2026-03-01"
               data-component="body">
    <br>
<p>Contract start date (Y-m-d). Must be today or later. Example: <code>2026-03-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_date"                data-endpoint="POSTapi-v1-contracts"
               value="2027-03-01"
               data-component="body">
    <br>
<p>optional Contract end date (Y-m-d). Must be after start_date. Example: <code>2027-03-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>monthly_rent</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="monthly_rent"                data-endpoint="POSTapi-v1-contracts"
               value="1200"
               data-component="body">
    <br>
<p>Monthly rent amount in €. Example: <code>1200</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>legal_deposit</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="legal_deposit"                data-endpoint="POSTapi-v1-contracts"
               value="1200"
               data-component="body">
    <br>
<p>Legal deposit amount in €. Example: <code>1200</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>additional_deposit</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="additional_deposit"                data-endpoint="POSTapi-v1-contracts"
               value="1200"
               data-component="body">
    <br>
<p>optional Additional deposit in €. Example: <code>1200</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant_pays_ibi</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-contracts" style="display: none">
            <input type="radio" name="tenant_pays_ibi"
                   value="true"
                   data-endpoint="POSTapi-v1-contracts"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-contracts" style="display: none">
            <input type="radio" name="tenant_pays_ibi"
                   value="false"
                   data-endpoint="POSTapi-v1-contracts"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>optional Whether tenant pays IBI. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant_pays_community_fees</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-contracts" style="display: none">
            <input type="radio" name="tenant_pays_community_fees"
                   value="true"
                   data-endpoint="POSTapi-v1-contracts"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-contracts" style="display: none">
            <input type="radio" name="tenant_pays_community_fees"
                   value="false"
                   data-endpoint="POSTapi-v1-contracts"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>optional Whether tenant pays community fees. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant_pays_garbage_fees</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-contracts" style="display: none">
            <input type="radio" name="tenant_pays_garbage_fees"
                   value="true"
                   data-endpoint="POSTapi-v1-contracts"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-contracts" style="display: none">
            <input type="radio" name="tenant_pays_garbage_fees"
                   value="false"
                   data-endpoint="POSTapi-v1-contracts"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>optional Whether tenant pays garbage fees. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>irpa_value</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="irpa_value"                data-endpoint="POSTapi-v1-contracts"
               value="1260"
               data-component="body">
    <br>
<p>optional IRPA reference value. Example: <code>1260</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_tensioned_area</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-contracts" style="display: none">
            <input type="radio" name="is_tensioned_area"
                   value="true"
                   data-endpoint="POSTapi-v1-contracts"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-contracts" style="display: none">
            <input type="radio" name="is_tensioned_area"
                   value="false"
                   data-endpoint="POSTapi-v1-contracts"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>optional Whether property is in a tensioned housing area. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant1_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant1_name"                data-endpoint="POSTapi-v1-contracts"
               value="Joan Puigdemon"
               data-component="body">
    <br>
<p>Primary tenant full name. Example: <code>Joan Puigdemon</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant1_dni</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant1_dni"                data-endpoint="POSTapi-v1-contracts"
               value="12345678A"
               data-component="body">
    <br>
<p>Primary tenant Spanish DNI/NIE. Example: <code>12345678A</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant1_email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant1_email"                data-endpoint="POSTapi-v1-contracts"
               value=""joan@rentoo.com""
               data-component="body">
    <br>
<p>Primary tenant email. Example: <code>"joan@rentoo.com"</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant1_phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant1_phone"                data-endpoint="POSTapi-v1-contracts"
               value="600111222"
               data-component="body">
    <br>
<p>Primary tenant phone. Example: <code>600111222</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant2_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant2_name"                data-endpoint="POSTapi-v1-contracts"
               value="Maria Garcia"
               data-component="body">
    <br>
<p>optional Secondary tenant full name. Example: <code>Maria Garcia</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant2_dni</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant2_dni"                data-endpoint="POSTapi-v1-contracts"
               value="87654321B"
               data-component="body">
    <br>
<p>optional Secondary tenant Spanish DNI/NIE. Example: <code>87654321B</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant2_email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant2_email"                data-endpoint="POSTapi-v1-contracts"
               value="maria@rentoo.com""
               data-component="body">
    <br>
<p>optional Secondary tenant email. Example: <code>maria@rentoo.com"</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant2_phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant2_phone"                data-endpoint="POSTapi-v1-contracts"
               value="600222333"
               data-component="body">
    <br>
<p>optional Secondary tenant phone. Example: <code>600222333</code></p>
        </div>
        </form>

                    <h2 id="contracts-GETapi-v1-contracts">List all contracts.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Admins see all contracts. Regular users only see contracts
that belong to properties they own.</p>

<span id="example-requests-GETapi-v1-contracts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/contracts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/contracts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-contracts">
            <blockquote>
            <p>Example response (200, admin success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;uuid&quot;,
            &quot;property_id&quot;: &quot;uuid&quot;,
            &quot;status&quot;: &quot;draft&quot;,
            &quot;monthly_rent&quot;: &quot;1200.00&quot;
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-contracts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-contracts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-contracts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-contracts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-contracts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-contracts" data-method="GET"
      data-path="api/v1/contracts"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-contracts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-contracts"
                    onclick="tryItOut('GETapi-v1-contracts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-contracts"
                    onclick="cancelTryOut('GETapi-v1-contracts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-contracts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/contracts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-contracts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-contracts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="contracts-GETapi-v1-contracts--uuid-">Show a specific contract.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Admins can view any contract. Regular users can only view contracts
on properties they own.</p>

<span id="example-requests-GETapi-v1-contracts--uuid-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/contracts/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/contracts/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-contracts--uuid-">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;uuid&quot;,
        &quot;property_id&quot;: &quot;uuid&quot;,
        &quot;status&quot;: &quot;draft&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Contract not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-contracts--uuid-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-contracts--uuid-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-contracts--uuid-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-contracts--uuid-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-contracts--uuid-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-contracts--uuid-" data-method="GET"
      data-path="api/v1/contracts/{uuid}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-contracts--uuid-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-contracts--uuid-"
                    onclick="tryItOut('GETapi-v1-contracts--uuid-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-contracts--uuid-"
                    onclick="cancelTryOut('GETapi-v1-contracts--uuid-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-contracts--uuid-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/contracts/{uuid}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-contracts--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-contracts--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>uuid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="uuid"                data-endpoint="GETapi-v1-contracts--uuid-"
               value="9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
               data-component="url">
    <br>
<p>The UUID of the contract. Example: <code>9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e</code></p>
            </div>
                    </form>

                    <h2 id="contracts-PUTapi-v1-contracts--uuid-">Update a contract.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Full update (PUT) of a contract. Admins can update any contract.
Regular users can only update contracts on their own properties.</p>

<span id="example-requests-PUTapi-v1-contracts--uuid-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/v1/contracts/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"property_id\": \"9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e\",
    \"status\": \"active\",
    \"start_date\": \"2026-03-01\",
    \"end_date\": \"2027-03-01\",
    \"monthly_rent\": 1400,
    \"legal_deposit\": 1400,
    \"additional_deposit\": 16,
    \"tenant_pays_ibi\": false,
    \"tenant_pays_community_fees\": false,
    \"tenant_pays_garbage_fees\": true,
    \"irpa_value\": 17,
    \"is_tensioned_area\": true,
    \"tenant1_name\": \"Joan Puigdemon\",
    \"tenant1_dni\": \"12345678A\",
    \"tenant1_email\": \"joan@rentoo.com\",
    \"tenant1_phone\": \"600111222\",
    \"tenant2_name\": \"i\",
    \"tenant2_dni\": \"(56425593\",
    \"tenant2_email\": \"lafayette.considine@example.com\",
    \"tenant2_phone\": \"aykcmyuwpwlvqwrs\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/contracts/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "property_id": "9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e",
    "status": "active",
    "start_date": "2026-03-01",
    "end_date": "2027-03-01",
    "monthly_rent": 1400,
    "legal_deposit": 1400,
    "additional_deposit": 16,
    "tenant_pays_ibi": false,
    "tenant_pays_community_fees": false,
    "tenant_pays_garbage_fees": true,
    "irpa_value": 17,
    "is_tensioned_area": true,
    "tenant1_name": "Joan Puigdemon",
    "tenant1_dni": "12345678A",
    "tenant1_email": "joan@rentoo.com",
    "tenant1_phone": "600111222",
    "tenant2_name": "i",
    "tenant2_dni": "(56425593",
    "tenant2_email": "lafayette.considine@example.com",
    "tenant2_phone": "aykcmyuwpwlvqwrs"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-contracts--uuid-">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;uuid&quot;,
        &quot;monthly_rent&quot;: &quot;1400.00&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Contract not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v1-contracts--uuid-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-contracts--uuid-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-contracts--uuid-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-contracts--uuid-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-contracts--uuid-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-contracts--uuid-" data-method="PUT"
      data-path="api/v1/contracts/{uuid}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-contracts--uuid-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-contracts--uuid-"
                    onclick="tryItOut('PUTapi-v1-contracts--uuid-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-contracts--uuid-"
                    onclick="cancelTryOut('PUTapi-v1-contracts--uuid-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-contracts--uuid-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/contracts/{uuid}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>uuid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="uuid"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
               data-component="url">
    <br>
<p>The UUID of the contract. Example: <code>9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>property_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="property_id"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
               data-component="body">
    <br>
<p>UUID of the property. Example: <code>9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="active"
               data-component="body">
    <br>
<p>Contract status: draft, active, or finalized. Example: <code>active</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_date"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="2026-03-01"
               data-component="body">
    <br>
<p>Contract start date (Y-m-d). Example: <code>2026-03-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_date"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="2027-03-01"
               data-component="body">
    <br>
<p>optional Contract end date (Y-m-d). Example: <code>2027-03-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>monthly_rent</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="monthly_rent"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="1400"
               data-component="body">
    <br>
<p>Monthly rent amount in €. Example: <code>1400</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>legal_deposit</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="legal_deposit"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="1400"
               data-component="body">
    <br>
<p>Legal deposit in €. Example: <code>1400</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>additional_deposit</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="additional_deposit"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="16"
               data-component="body">
    <br>
<p>Must be at least 0. Must not be greater than 999999.99. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant_pays_ibi</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-contracts--uuid-" style="display: none">
            <input type="radio" name="tenant_pays_ibi"
                   value="true"
                   data-endpoint="PUTapi-v1-contracts--uuid-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-contracts--uuid-" style="display: none">
            <input type="radio" name="tenant_pays_ibi"
                   value="false"
                   data-endpoint="PUTapi-v1-contracts--uuid-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant_pays_community_fees</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-contracts--uuid-" style="display: none">
            <input type="radio" name="tenant_pays_community_fees"
                   value="true"
                   data-endpoint="PUTapi-v1-contracts--uuid-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-contracts--uuid-" style="display: none">
            <input type="radio" name="tenant_pays_community_fees"
                   value="false"
                   data-endpoint="PUTapi-v1-contracts--uuid-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant_pays_garbage_fees</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-contracts--uuid-" style="display: none">
            <input type="radio" name="tenant_pays_garbage_fees"
                   value="true"
                   data-endpoint="PUTapi-v1-contracts--uuid-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-contracts--uuid-" style="display: none">
            <input type="radio" name="tenant_pays_garbage_fees"
                   value="false"
                   data-endpoint="PUTapi-v1-contracts--uuid-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>irpa_value</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="irpa_value"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="17"
               data-component="body">
    <br>
<p>Must be at least 0. Must not be greater than 999999.99. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_tensioned_area</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-contracts--uuid-" style="display: none">
            <input type="radio" name="is_tensioned_area"
                   value="true"
                   data-endpoint="PUTapi-v1-contracts--uuid-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-contracts--uuid-" style="display: none">
            <input type="radio" name="is_tensioned_area"
                   value="false"
                   data-endpoint="PUTapi-v1-contracts--uuid-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant1_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant1_name"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="Joan Puigdemon"
               data-component="body">
    <br>
<p>Primary tenant full name. Example: <code>Joan Puigdemon</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant1_dni</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant1_dni"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="12345678A"
               data-component="body">
    <br>
<p>Primary tenant DNI. Example: <code>12345678A</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant1_email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant1_email"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="joan@rentoo.com"
               data-component="body">
    <br>
<p>Primary tenant email. Example: <code>joan@rentoo.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant1_phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant1_phone"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="600111222"
               data-component="body">
    <br>
<p>Primary tenant phone. Example: <code>600111222</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant2_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant2_name"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="i"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>i</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant2_dni</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant2_dni"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="(56425593"
               data-component="body">
    <br>
<p>Must match the regex /^([0-9]{8}. Example: <code>(56425593</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant2_email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant2_email"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="lafayette.considine@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 100 characters. Example: <code>lafayette.considine@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tenant2_phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tenant2_phone"                data-endpoint="PUTapi-v1-contracts--uuid-"
               value="aykcmyuwpwlvqwrs"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>aykcmyuwpwlvqwrs</code></p>
        </div>
        </form>

                    <h2 id="contracts-DELETEapi-v1-contracts--uuid-">Delete a contract (soft delete).</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Soft deletes a contract. Admins can delete any contract.
Regular users can only delete contracts on their own properties.</p>

<span id="example-requests-DELETEapi-v1-contracts--uuid-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/v1/contracts/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/contracts/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-contracts--uuid-">
            <blockquote>
            <p>Example response (204, success):</p>
        </blockquote>
                <pre>
<code>Empty response</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Contract not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v1-contracts--uuid-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-contracts--uuid-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-contracts--uuid-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-contracts--uuid-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-contracts--uuid-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-contracts--uuid-" data-method="DELETE"
      data-path="api/v1/contracts/{uuid}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-contracts--uuid-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-contracts--uuid-"
                    onclick="tryItOut('DELETEapi-v1-contracts--uuid-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-contracts--uuid-"
                    onclick="cancelTryOut('DELETEapi-v1-contracts--uuid-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-contracts--uuid-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/contracts/{uuid}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-contracts--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-contracts--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>uuid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="uuid"                data-endpoint="DELETEapi-v1-contracts--uuid-"
               value="9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
               data-component="url">
    <br>
<p>The UUID of the contract. Example: <code>9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e</code></p>
            </div>
                    </form>

                <h1 id="properties">Properties</h1>

    

                                <h2 id="properties-POSTapi-v1-properties">Create a new property.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Creates a property and automatically assigns it to the authenticated user as owner.</p>

<span id="example-requests-POSTapi-v1-properties">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/properties" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"address\": \"Carrer de Balmes, 100\",
    \"city\": \"Barcelona\",
    \"postal_code\": \"08008\",
    \"province\": \"Barcelona\",
    \"cadastral_reference\": \"9876543ZX9876T0001TT\",
    \"surface_area\": 85.5,
    \"bedrooms\": 3,
    \"bathrooms\": 2,
    \"description\": \"Hermoso Piso en Eixample\",
    \"energy_certificate_rating\": \"C\",
    \"energy_certificate_number\": \"TT98765432\",
    \"energy_certificate_expiry\": \"2030-01-01\",
    \"habitability_certificate_number\": \"CHB34567891011\",
    \"habitability_certificate_expiry\": \"2030-06-01\",
    \"last_rent_amount\": 1200,
    \"ibi_annual_amount\": 450,
    \"community_fees_monthly\": 80,
    \"garbage_fees_annual\": 120
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/properties"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "address": "Carrer de Balmes, 100",
    "city": "Barcelona",
    "postal_code": "08008",
    "province": "Barcelona",
    "cadastral_reference": "9876543ZX9876T0001TT",
    "surface_area": 85.5,
    "bedrooms": 3,
    "bathrooms": 2,
    "description": "Hermoso Piso en Eixample",
    "energy_certificate_rating": "C",
    "energy_certificate_number": "TT98765432",
    "energy_certificate_expiry": "2030-01-01",
    "habitability_certificate_number": "CHB34567891011",
    "habitability_certificate_expiry": "2030-06-01",
    "last_rent_amount": 1200,
    "ibi_annual_amount": 450,
    "community_fees_monthly": 80,
    "garbage_fees_annual": 120
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-properties">
            <blockquote>
            <p>Example response (201, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;uuid-here&quot;,
        &quot;city&quot;: &quot;Barcelona&quot;,
        &quot;owner_id&quot;: &quot;owner-uuid&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The cadastral reference field must be 20 characters.&quot;,
    &quot;errors&quot;: {
        &quot;cadastral_reference&quot;: [
            &quot;The cadastral reference field must be 20 characters.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-properties" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-properties"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-properties"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-properties" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-properties">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-properties" data-method="POST"
      data-path="api/v1/properties"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-properties', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-properties"
                    onclick="tryItOut('POSTapi-v1-properties');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-properties"
                    onclick="cancelTryOut('POSTapi-v1-properties');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-properties"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/properties</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-properties"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-properties"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-v1-properties"
               value="Carrer de Balmes, 100"
               data-component="body">
    <br>
<p>Street address. Max 250 characters. Example: <code>Carrer de Balmes, 100</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="POSTapi-v1-properties"
               value="Barcelona"
               data-component="body">
    <br>
<p>City. Max 100 characters. Example: <code>Barcelona</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>postal_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="postal_code"                data-endpoint="POSTapi-v1-properties"
               value="08008"
               data-component="body">
    <br>
<p>Postal code. Max 10 characters. Example: <code>08008</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>province</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="province"                data-endpoint="POSTapi-v1-properties"
               value="Barcelona"
               data-component="body">
    <br>
<p>Province. Max 100 characters. Example: <code>Barcelona</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cadastral_reference</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="cadastral_reference"                data-endpoint="POSTapi-v1-properties"
               value="9876543ZX9876T0001TT"
               data-component="body">
    <br>
<p>Spanish cadastral reference. Exactly 20 alphanumeric characters, must be unique. Example: <code>9876543ZX9876T0001TT</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>surface_area</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="surface_area"                data-endpoint="POSTapi-v1-properties"
               value="85.5"
               data-component="body">
    <br>
<p>Surface area in m². Between 10 and 9999.99. Example: <code>85.5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bedrooms</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="bedrooms"                data-endpoint="POSTapi-v1-properties"
               value="3"
               data-component="body">
    <br>
<p>Number of bedrooms. Between 0 and 255. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bathrooms</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="bathrooms"                data-endpoint="POSTapi-v1-properties"
               value="2"
               data-component="body">
    <br>
<p>Number of bathrooms. Between 0 and 255. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v1-properties"
               value="Hermoso Piso en Eixample"
               data-component="body">
    <br>
<p>optional Property description. Max 1000 characters. Example: <code>Hermoso Piso en Eixample</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>energy_certificate_rating</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="energy_certificate_rating"                data-endpoint="POSTapi-v1-properties"
               value="C"
               data-component="body">
    <br>
<p>Energy rating (A–G). Example: <code>C</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>energy_certificate_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="energy_certificate_number"                data-endpoint="POSTapi-v1-properties"
               value="TT98765432"
               data-component="body">
    <br>
<p>Alphanumeric certificate number. Max 50 characters. Example: <code>TT98765432</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>energy_certificate_expiry</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="energy_certificate_expiry"                data-endpoint="POSTapi-v1-properties"
               value="2030-01-01"
               data-component="body">
    <br>
<p>Expiry date, must be after today (Y-m-d). Example: <code>2030-01-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>habitability_certificate_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="habitability_certificate_number"                data-endpoint="POSTapi-v1-properties"
               value="CHB34567891011"
               data-component="body">
    <br>
<p>Alphanumeric certificate number. Max 50 characters. Example: <code>CHB34567891011</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>habitability_certificate_expiry</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="habitability_certificate_expiry"                data-endpoint="POSTapi-v1-properties"
               value="2030-06-01"
               data-component="body">
    <br>
<p>Expiry date, must be after today (Y-m-d). Example: <code>2030-06-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_rent_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="last_rent_amount"                data-endpoint="POSTapi-v1-properties"
               value="1200"
               data-component="body">
    <br>
<p>optional Last rent amount in €. Max 999999.99. Example: <code>1200</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ibi_annual_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="ibi_annual_amount"                data-endpoint="POSTapi-v1-properties"
               value="450"
               data-component="body">
    <br>
<p>optional Annual IBI in €. Max 999999.99. Example: <code>450</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>community_fees_monthly</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="community_fees_monthly"                data-endpoint="POSTapi-v1-properties"
               value="80"
               data-component="body">
    <br>
<p>optional Monthly community fees in €. Max 999999.99. Example: <code>80</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>garbage_fees_annual</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="garbage_fees_annual"                data-endpoint="POSTapi-v1-properties"
               value="120"
               data-component="body">
    <br>
<p>optional Annual garbage fees in €. Max 999999.99. Example: <code>120</code></p>
        </div>
        </form>

                    <h2 id="properties-GETapi-v1-properties">List all properties.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns all properties for admins. Regular users only see their own properties.</p>

<span id="example-requests-GETapi-v1-properties">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/properties" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/properties"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-properties">
            <blockquote>
            <p>Example response (200, admin success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;uuid-here&quot;,
            &quot;owner_id&quot;: &quot;owner-uuid&quot;,
            &quot;address&quot;: &quot;Carrer de Balmes, 100&quot;,
            &quot;city&quot;: &quot;Barcelona&quot;,
            &quot;bedrooms&quot;: 3,
            &quot;bathrooms&quot;: 2
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-properties" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-properties"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-properties"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-properties" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-properties">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-properties" data-method="GET"
      data-path="api/v1/properties"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-properties', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-properties"
                    onclick="tryItOut('GETapi-v1-properties');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-properties"
                    onclick="cancelTryOut('GETapi-v1-properties');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-properties"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/properties</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-properties"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-properties"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="properties-GETapi-v1-properties--uuid-">Show a specific property.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Admins can view any property. Regular users can only view their own properties.</p>

<span id="example-requests-GETapi-v1-properties--uuid-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/properties/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/properties/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-properties--uuid-">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;uuid-here&quot;,
        &quot;city&quot;: &quot;Barcelona&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Property not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-properties--uuid-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-properties--uuid-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-properties--uuid-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-properties--uuid-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-properties--uuid-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-properties--uuid-" data-method="GET"
      data-path="api/v1/properties/{uuid}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-properties--uuid-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-properties--uuid-"
                    onclick="tryItOut('GETapi-v1-properties--uuid-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-properties--uuid-"
                    onclick="cancelTryOut('GETapi-v1-properties--uuid-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-properties--uuid-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/properties/{uuid}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-properties--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-properties--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>uuid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="uuid"                data-endpoint="GETapi-v1-properties--uuid-"
               value="9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
               data-component="url">
    <br>
<p>The UUID of the property. Example: <code>9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e</code></p>
            </div>
                    </form>

                    <h2 id="properties-PUTapi-v1-properties--uuid-">Update a property.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Full update (PUT) of a property. Admins can update any property.
Regular users can only update their own properties.</p>

<span id="example-requests-PUTapi-v1-properties--uuid-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/v1/properties/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"address\": \"Carrer de Balmes, 100\",
    \"city\": \"Girona\",
    \"postal_code\": \"17001\",
    \"province\": \"Girona\",
    \"cadastral_reference\": \"9876543ZX9876T0001TT\",
    \"surface_area\": 85.5,
    \"bedrooms\": 3,
    \"bathrooms\": 2,
    \"description\": \"Renovated flat\",
    \"energy_certificate_rating\": \"B\",
    \"energy_certificate_number\": \"TT98765432\",
    \"energy_certificate_expiry\": \"2031-01-01\",
    \"habitability_certificate_number\": \"CHB34567891011\",
    \"habitability_certificate_expiry\": \"2031-06-01\",
    \"last_rent_amount\": 1400,
    \"ibi_annual_amount\": 500,
    \"community_fees_monthly\": 90,
    \"garbage_fees_annual\": 130
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/properties/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "address": "Carrer de Balmes, 100",
    "city": "Girona",
    "postal_code": "17001",
    "province": "Girona",
    "cadastral_reference": "9876543ZX9876T0001TT",
    "surface_area": 85.5,
    "bedrooms": 3,
    "bathrooms": 2,
    "description": "Renovated flat",
    "energy_certificate_rating": "B",
    "energy_certificate_number": "TT98765432",
    "energy_certificate_expiry": "2031-01-01",
    "habitability_certificate_number": "CHB34567891011",
    "habitability_certificate_expiry": "2031-06-01",
    "last_rent_amount": 1400,
    "ibi_annual_amount": 500,
    "community_fees_monthly": 90,
    "garbage_fees_annual": 130
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-properties--uuid-">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;uuid-here&quot;,
        &quot;city&quot;: &quot;Girona&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Property not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v1-properties--uuid-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-properties--uuid-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-properties--uuid-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-properties--uuid-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-properties--uuid-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-properties--uuid-" data-method="PUT"
      data-path="api/v1/properties/{uuid}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-properties--uuid-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-properties--uuid-"
                    onclick="tryItOut('PUTapi-v1-properties--uuid-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-properties--uuid-"
                    onclick="cancelTryOut('PUTapi-v1-properties--uuid-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-properties--uuid-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/properties/{uuid}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>uuid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="uuid"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
               data-component="url">
    <br>
<p>The UUID of the property. Example: <code>9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="Carrer de Balmes, 100"
               data-component="body">
    <br>
<p>Street address. Max 250 characters. Example: <code>Carrer de Balmes, 100</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="Girona"
               data-component="body">
    <br>
<p>City. Max 100 characters. Example: <code>Girona</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>postal_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="postal_code"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="17001"
               data-component="body">
    <br>
<p>Postal code. Max 10 characters. Example: <code>17001</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>province</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="province"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="Girona"
               data-component="body">
    <br>
<p>Province. Max 100 characters. Example: <code>Girona</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cadastral_reference</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="cadastral_reference"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="9876543ZX9876T0001TT"
               data-component="body">
    <br>
<p>Exactly 20 alphanumeric characters. Example: <code>9876543ZX9876T0001TT</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>surface_area</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="surface_area"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="85.5"
               data-component="body">
    <br>
<p>Surface area in m². Between 10 and 9999.99. Example: <code>85.5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bedrooms</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="bedrooms"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="3"
               data-component="body">
    <br>
<p>Number of bedrooms. Between 0 and 255. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bathrooms</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="bathrooms"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="2"
               data-component="body">
    <br>
<p>Number of bathrooms. Between 0 and 255. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="Renovated flat"
               data-component="body">
    <br>
<p>optional Property description. Max 1000 characters. Example: <code>Renovated flat</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>energy_certificate_rating</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="energy_certificate_rating"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="B"
               data-component="body">
    <br>
<p>Energy rating (A–G). Example: <code>B</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>energy_certificate_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="energy_certificate_number"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="TT98765432"
               data-component="body">
    <br>
<p>Alphanumeric certificate number. Max 50 characters. Example: <code>TT98765432</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>energy_certificate_expiry</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="energy_certificate_expiry"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="2031-01-01"
               data-component="body">
    <br>
<p>Expiry date (Y-m-d). Example: <code>2031-01-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>habitability_certificate_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="habitability_certificate_number"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="CHB34567891011"
               data-component="body">
    <br>
<p>Alphanumeric certificate number. Max 50 characters. Example: <code>CHB34567891011</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>habitability_certificate_expiry</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="habitability_certificate_expiry"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="2031-06-01"
               data-component="body">
    <br>
<p>Expiry date (Y-m-d). Example: <code>2031-06-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_rent_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="last_rent_amount"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="1400"
               data-component="body">
    <br>
<p>optional Last rent amount in €. Max 999999.99. Example: <code>1400</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ibi_annual_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="ibi_annual_amount"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="500"
               data-component="body">
    <br>
<p>optional Annual IBI in €. Max 999999.99. Example: <code>500</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>community_fees_monthly</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="community_fees_monthly"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="90"
               data-component="body">
    <br>
<p>optional Monthly community fees in €. Max 999999.99. Example: <code>90</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>garbage_fees_annual</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="garbage_fees_annual"                data-endpoint="PUTapi-v1-properties--uuid-"
               value="130"
               data-component="body">
    <br>
<p>optional Annual garbage fees in €. Max 999999.99. Example: <code>130</code></p>
        </div>
        </form>

                    <h2 id="properties-DELETEapi-v1-properties--uuid-">Delete a property (soft delete).</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Soft deletes a property. Fails if the property has active contracts.
Admins can delete any property. Regular users can only delete their own properties.</p>

<span id="example-requests-DELETEapi-v1-properties--uuid-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/v1/properties/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/properties/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-properties--uuid-">
            <blockquote>
            <p>Example response (204, success):</p>
        </blockquote>
                <pre>
<code>Empty response</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Property not found&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (409, has contracts):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Cannot delete property with 2 active contracts. Please delete them first.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v1-properties--uuid-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-properties--uuid-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-properties--uuid-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-properties--uuid-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-properties--uuid-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-properties--uuid-" data-method="DELETE"
      data-path="api/v1/properties/{uuid}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-properties--uuid-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-properties--uuid-"
                    onclick="tryItOut('DELETEapi-v1-properties--uuid-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-properties--uuid-"
                    onclick="cancelTryOut('DELETEapi-v1-properties--uuid-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-properties--uuid-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/properties/{uuid}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-properties--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-properties--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>uuid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="uuid"                data-endpoint="DELETEapi-v1-properties--uuid-"
               value="9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
               data-component="url">
    <br>
<p>The UUID of the property. Example: <code>9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e</code></p>
            </div>
                    </form>

                <h1 id="users">Users</h1>

    

                                <h2 id="users-GETapi-v1-users">List all users.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns a list of all registered users. Only accessible by admins.</p>

<span id="example-requests-GETapi-v1-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/users" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-users">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;uuid-here&quot;,
            &quot;name&quot;: &quot;Joan Puig&quot;,
            &quot;email&quot;: &quot;joan@rentoo.com&quot;,
            &quot;dni&quot;: &quot;12345678A&quot;,
            &quot;phone&quot;: &quot;600111222&quot;,
            &quot;city&quot;: &quot;Barcelona&quot;,
            &quot;province&quot;: &quot;Barcelona&quot;,
            &quot;roles&quot;: [
                &quot;User&quot;
            ],
            &quot;created_at&quot;: &quot;2026-02-20T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-20T10:00:00.000000Z&quot;
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-users" data-method="GET"
      data-path="api/v1/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-users"
                    onclick="tryItOut('GETapi-v1-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-users"
                    onclick="cancelTryOut('GETapi-v1-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="users-GETapi-v1-users--uuid-">Show a specific user.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns the details of a user. Admins can view any user.
Regular users can only view their own profile.</p>

<span id="example-requests-GETapi-v1-users--uuid-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/users/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-users--uuid-">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;uuid-here&quot;,
        &quot;name&quot;: &quot;Joan Puig&quot;,
        &quot;email&quot;: &quot;joan@rentoo.com&quot;,
        &quot;dni&quot;: &quot;12345678A&quot;,
        &quot;phone&quot;: &quot;600111222&quot;,
        &quot;city&quot;: &quot;Barcelona&quot;,
        &quot;province&quot;: &quot;Barcelona&quot;,
        &quot;roles&quot;: [
            &quot;User&quot;
        ],
        &quot;created_at&quot;: &quot;2026-02-20T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-02-20T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;User not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-users--uuid-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-users--uuid-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-users--uuid-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-users--uuid-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-users--uuid-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-users--uuid-" data-method="GET"
      data-path="api/v1/users/{uuid}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-users--uuid-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-users--uuid-"
                    onclick="tryItOut('GETapi-v1-users--uuid-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-users--uuid-"
                    onclick="cancelTryOut('GETapi-v1-users--uuid-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-users--uuid-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/users/{uuid}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-users--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-users--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>uuid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="uuid"                data-endpoint="GETapi-v1-users--uuid-"
               value="9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
               data-component="url">
    <br>
<p>The UUID of the user. Example: <code>9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e</code></p>
            </div>
                    </form>

                    <h2 id="users-DELETEapi-v1-users--uuid-">Delete a user (soft delete).</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Soft deletes a user account. The record is preserved in the database
with a deleted_at timestamp but will no longer appear in normal queries.
Admins can delete any user. Regular users can only delete their own account.</p>

<span id="example-requests-DELETEapi-v1-users--uuid-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/v1/users/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-users--uuid-">
            <blockquote>
            <p>Example response (204, success):</p>
        </blockquote>
                <pre>
<code>Empty response</code>
 </pre>
            <blockquote>
            <p>Example response (401, unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;User not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v1-users--uuid-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-users--uuid-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-users--uuid-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-users--uuid-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-users--uuid-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-users--uuid-" data-method="DELETE"
      data-path="api/v1/users/{uuid}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-users--uuid-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-users--uuid-"
                    onclick="tryItOut('DELETEapi-v1-users--uuid-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-users--uuid-"
                    onclick="cancelTryOut('DELETEapi-v1-users--uuid-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-users--uuid-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/users/{uuid}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-users--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-users--uuid-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>uuid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="uuid"                data-endpoint="DELETEapi-v1-users--uuid-"
               value="9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e"
               data-component="url">
    <br>
<p>The UUID of the user. Example: <code>9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
