RENAME TABLE
    permissions TO groups,
    user_permission_matches TO groups_users_raw,
    permission_page_matches TO groups_pages;

ALTER TABLE `groups_pages` CHANGE `permission_id` `group_id` INT(15) NOT NULL;

ALTER TABLE `groups_users_raw`
    CHANGE `permission_id` `group_id` INT(11) NOT NULL;
    ADD `user_is_group` BOOLEAN NOT NULL DEFAULT FALSE AFTER `group_id`;

CREATE OR REPLACE VIEW groups_users AS
    SELECT id, user_id, group_id
    FROM groups_users_raw
    WHERE user_is_group = 0
    UNION
    SELECT ug1.id+ug2.id*10000 AS id, ug1.user_id, ug2.group_id
    FROM groups_users_raw ug1
    JOIN groups_users_raw ug2 ON (ug1.group_id = ug2.user_id)
    WHERE ug2.user_is_group = 1
    AND ug1.user_is_group = 0
    UNION
    SELECT ug1.id+ug2.id*10000+ug3.id*20000 AS id, ug1.user_id, ug3.group_id
    FROM groups_users_raw ug1
    JOIN groups_users_raw ug2 ON (ug1.group_id = ug2.user_id)
    JOIN groups_users_raw ug3 ON (ug2.group_id = ug3.user_id)
    WHERE ug3.user_is_group = 1
    AND ug2.user_is_group = 1
    AND ug1.user_is_group = 0
    UNION
    SELECT ug1.id+ug2.id*10000+ug3.id*20000+ug4.id*30000 AS id, ug1.user_id, ug4.group_id
    FROM groups_users_raw ug1
    JOIN groups_users_raw ug2 ON (ug1.group_id = ug2.user_id)
    JOIN groups_users_raw ug3 ON (ug2.group_id = ug3.user_id)
    JOIN groups_users_raw ug4 ON (ug3.group_id = ug4.user_id)
    WHERE ug4.user_is_group = 1
    AND ug3.user_is_group = 1
    AND ug2.user_is_group = 1
    AND ug1.user_is_group = 0
