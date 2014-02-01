<h1>ScanDB Front end</h1>
<p>This script reads MP3 files from a folder and displays them in a table.</p>
<p>It is a front end for the SDRSharp call logger</p>
<p>Designed as a police scanner database the column fields follow:</p>
<pre>Length of track, Talkgroup + RadioID, Time(UNIX), Time(Local), File Size (Bytes)</pre>

<h2>Prereqs:</h2>
<ul>
	<li>everything search (http://www.voidtools.com/)</li>
	<li>PHP and Apache</li>
</ul>

<h2>Notes:</h2>
<ul>
	<li>The index page separates into two types of searches: date based lookup, and query</li>
	<li>Date based search is performed by listing the contents of a directory</li>
	<li>Instead of a traiditional database, Everything search is used for quickly pulling up results for a query</li>
	<li>Directory formatting follows</li>
	<li><pre>[Path to calls]/[year]/[MM]/[DD]/</pre></li>
	<li><pre>(e.g) C:/calls/2014/01/22/</pre></li>
	<li>This script <b>requires</b> modifications to work properly, it was not designed for easy portability</li>
	<li>At the very least, file locations and substrings need to be modified to work correctly</li>
</ul>

<h2>Todo:</h2>
<ul>
	<li>Better portability between OSs</li>
	<li>Fix substrings to  use relative directory names</li>
</ul>
