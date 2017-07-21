=== File Inliner ===
Contributors:
Donate link:
Tags: code, text, files, inline
Requires at least: 2.0
Tested up to: 2.7.1
Stable tag: 1.2.0

This plugin displays the content of a file in a post.


== Description ==

This plugin displays the content of a file in a post. The content of the file
(called a "snippet") is put in a <code>&lt;pre&gt;&lt;/pre&gt;</code> block by default.

It has the following advantages over pasting the content of the file in your post
yourself:

* When the file is modified, no need to modify the posts referring to it
* Indentation is preserved by default (useful to show code snippets)
* Can optionally provide a link to the file (no need to copy-paste your snippet)

If requested (see the <code>preserveformat</code> parameter), the content of the file
is put in a <code>&lt;div&gt;&lt;/div&gt;</code> block, with each line (delimited by
the carriage return) in its own <code>&lt;p&gt;&lt;/p&gt;</code> block.

= Usage =

Syntax: <code>[file lang="some_lang" start="a_line_number" end="a_line_number" link="on_or_off" style="some_style_properties" preserveformat="on_or_off"]path/to/your/file[/file]</code>

Note: The order of the attributes is mandatory!


= Example: Inlining of a file =

In your post, write <code>[file]path/to/your/file[/file]</code>. That's it!

= Example: Using a syntax highlighter plugin =

If you write <code>[file lang="cpp"]path/to/your/file[/file]</code> (for instance),
and if the syntax highlighter plugin you use supports
the <code>&lt;pre lang="*"&gt;&lt;/pre&gt;</code> syntax (most does), then the content
of your file will be processed by the syntax highlighter plugin as usual.

= Example: Provide a link to the file =

If you write <code>[file link="on"]path/to/your/file[/file]</code>, a link will
be automatically added to the top left of the text area.

= Example: Inline a subset of a file =

If you write <code>[file start="10" end="20"]path/to/your/file[/file]</code>,
only the lines 10 to 20 of the file will be displayed. You can omit the start
(ie. "from beginning to line 20") or the end (ie. "from line 10 to the end of
the file") if you want.

= Example: Set the color of the text to red =

In your post, write <code>[file style="color: #FF0000;"]path/to/your/file[/file]</code>.

= Example: Prevent the plugin to process a [file][/file] block =

Just write <code>[file off]your content[/file]</code>.

Note: The 'off' attribute must come BEFORE any other ones.


== Installation ==

1. Upload `fileinliner.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= How is the content of the file retrieved by the plugin? =

The PHP function
[<code>file_get_contents</code>](http://fr.php.net/manual/en/function.file-get-contents.php)
is used. Your file must be readable by the web server.

= Can I use a URL instead of a path to the file? =

From the [<code>file_get_contents</code>](http://fr.php.net/manual/en/function.file-get-contents.php)
documentation: A URL can be used as a filename with this function if the
[fopen wrappers](http://fr.php.net/manual/en/filesystem.configuration.php#ini.allow-url-fopen)
have been enabled.

Check your server configuration.

== Screenshots ==

1. Inlining of a text file
2. Inlining of a C++ file, with syntax highlighting (using CodeHighlighter)
3. Inlining of a Python file, with syntax highlighting (using CodeHighlighter),
and a download link
4. Inlining of some lines of a Python file, with syntax highlighting (using
CodeHighlighter), and a download link
