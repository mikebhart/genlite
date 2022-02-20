# BEFORE

SELECT * FROM wp_options WHERE option_value like '%oldurl.com%';

SELECT * from wp_posts WHERE guid like '%oldurl.com%';
SELECT * from wp_posts WHERE post_content like '%oldurl.com%';

SELECT * from wp_postmeta WHERE meta_value like '%oldurl.com%';


# UPDATE


UPDATE wp_options SET option_value = replace(option_value, 'oldurl.com', 'newurl.com') WHERE option_name = 'home' OR option_name = 'siteurl';

UPDATE wp_posts SET guid = replace(guid, 'oldurl.com','newurl.com');
UPDATE wp_posts SET post_content = replace(post_content, 'oldurl.com', 'newurl.com'); 

UPDATE wp_postmeta SET meta_value = replace(meta_value,'oldurl.com','newurl.com');


# AFTER


SELECT * FROM wp_options WHERE option_value like '%newurl.com%';

SELECT * from wp_posts WHERE guid like '%newurl.com%';
SELECT * from wp_posts WHERE post_content like '%newurl.com%';

SELECT * from wp_postmeta WHERE meta_value like '%newurl.com%';
