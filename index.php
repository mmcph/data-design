<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Data Design Project</title>
		<link rel="stylesheet" href="./style.css">
	</head>
	<body>
		<h1>Data Design Project</h1>
		<hr>
		<div id="personaContainer">
			<h2>Persona</h2>
			<h3>Jack Jackson</h3>
			<ul id="persona">
				<li><strong>Age:</strong> 32</li>
				<li><strong>Gender:</strong> Male</li>
				<li><strong>Profession:</strong> Web Developer (Front End)</li>
				<li><strong>Technology:</strong> 2017 Macbook Pro, macOS 10.13 High Sierra</li>
				<li><strong>Attitude:</strong> Jack uses Github to share his code with his peers. Github is nice, but there
					are several additional steps before a user can preview how code is displayed by the browser. Jack needs a
					simpler solution.
				</li>
				<li><strong>Goals:</strong> Jack needs a simple method for sharing his HTML/CSS/JS projects with the world.
					He should be able to save his code to the app, or better yet, use the app to code while a live preview
					shows him the changes he is making. Others should be able to see his code and how it's displayed by the
					browser all in one place without the need for intermediate steps.
				</li>
				<li><strong>Frustrations:</strong> Jack feels that his front-end skills are not appreciated by his peers.
					He's created several exciting visual projects and wishes to share them, but the disconnect between a git
					repo and the browser representation of his code means that very few people see his work.
				</li>
			</ul>
		</div>
		<hr>
		<div id="userStoriesContainer">
			<h2>User Stories</h2>
			<p>As a registered user, Jack wants to post his HTML/CSS/JS code for others to see, in both raw and rendered
				format.</p>
			<p>As a public user, I want to browse others' code and see it represented visually by the app.</p>
			<p>As a registered user, I want to comment on a post.</p>
		</div>
		<hr>
		<div id="useCaseContainer">
			<h2>Use Case/Interaction Flow</h2>
			<ul id="useCase">
				<li><strong>Description:</strong>&nbsp;Posting a pen</li>
				<li><strong>Persona:</strong>&nbsp;Jack Jackson</li>
				<li><strong>Preconditions:</strong>&nbsp;Jack has registered his account and wishes to share his code with
					others.
				</li>
				<li><strong>Postconditions:</strong>&nbsp;Jack's work now exists on codepen.io in the form of a searchable
					'pen' that displays his code and also renders it in the browser.
				</li>
			</ul>
			<ol id="interactionFlow">
				<li>Jack clicks the "Create New Pen" link.</li>
				<li>The server sends the pen creation page to Jack.</li>
				<li>Jack writes his HTML/CSS/JS code and clicks "Save".</li>
				<li>The pen is stored in the database.</li>
			</ol>
		</div>
		<hr>
		<div id="conceptualModel">
			<h2>Conceptual Model</h2>
			<ul>
				<li><strong>profile</strong>
					<ul>
						<li>profileId (primary key)</li>
						<li>profileName</li>
						<li>profileUsername</li>
						<li>profileEmail</li>
						<li>profileAvatar</li>
						<li>profileIsPro (checks for Pro membership)</li>
						<!-- excluding things like 'collections' / 'posts' / passwords etc. for project relevance -->
					</ul>
				</li>
				<li><strong>pen</strong>
					<ul>
						<li>penId (primary key)</li>
						<li>penProfileId (foreign key, references profile(profileId))</li>
						<li>penName</li>
						<li>penHtmlContent</li>
						<li>penCssContent</li>
						<li>penJsContent</li>
					</ul>
				</li>
				<li><strong>penComments</strong>
					<ul>
						<li>commentId (primary key)</li>
						<li>commentFromProfileId (foreign key, references profile(profileId))</li>
						<li>commentToPenId (foreign key, references pen(penId))</li>
						<li>commentDateTime</li>
						<li>commentContent</li>
					</ul>
				</li>
			</ul>
		</div>
		<hr>
		<div id="svgContainer">
			<h2>Entity Relationship Diagram (ERD)</h2>
			<img src="codepen-erd.svg" alt="image of data structure ERD">
		</div>
	</body>
</html>