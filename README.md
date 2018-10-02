# WPMU Other Blog Post Renderer

## Short description
The plugin allows for any sub-blog from the network to load and render a page content from the main blog as it is its
 own and under the requested URI of the sub-blog without 404 error.
 
## Full description
The purpose is to have across the network some pages that are equal everywhere. Even when a change for the source 
page will be made then it must appear on every blog, which requests the page. The 404 error appear only if the main 
blog also hasn't the requested page.

With such idea you can avoid duplicate some content across the network and make updates in one place, but not in ever
 website.
 
## How it works
You just request a page from a sub-blog, and in case of it absences on the sub-blog, the plugin will try to find the 
post with the same **path** in the main blog. If it is found, then it will be rendered under the sub-blog theme.

## Features
1. It works for a single post, or post meta, request only, and doesn't work when the list of post is requested.
1. Independent on themes of sub-blogs and main blog.
1. Loads only the Page post type.
1. A full post with its meta will be rendered, i.e. author, comments, etc.
1. Doesn't require REST API approach for post retrieving, i.e. there is a server rendering.
1. 404 Error won't appear. SEO won't be affected if you won't include this page in `sitemap.xml`, at least.
1. Works for multisite only.
1. Independent of changes for an ID of the main blog.
1. Super easy to install.
1. No need to setup - just activate.

## Potential problems
In case when you requested a post that doesn't exist on the sub-blog, but exists as a parent for some posts on the 
main blog than, unfortunately, the content of the parent post will be added.
**Ask me to avoid that contradiction if you would like to use this plugin.**  

# Future & Contribution
Perhaps, somebody will find the plugin useful, but with a few features more, which are not currently implemented. 
Some of them are below:
* to render every post type;
* to choose a blog from the network that will play the role of the main blog;
* to change post meta before rendering;
* to retrieve posts and data from external Wordpress sites with opened REST;
* to have an adequate options page with global parameters
* to have a control page which allows to control posts from other blogs and set them up before render, i.e. the 
ability to select one post and change some meta for it and save, and after that every request for the post will be 
additionally updated with your data.
* to have an option to exclude posts of the main blog to be rendered on the sub-blog
* to be able to work with requests of list of posts.

Also, I think the plugin should have much more pretty file structure and other developer's things, but for now I 
suggest to consider it like a prototype version, so it doesn't require such things.

Eventually, it would be great to find a contributor, who could share his/her thought about necessity of the plugin 
development, at least. 

Piece!


##Changelog

###1.0.1
- added fetching of a post meta from a specified blog

###1.0.0
- fetching of posts from a specified blog