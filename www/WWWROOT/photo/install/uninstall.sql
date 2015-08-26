
delete from `{P}_base_pageset` where `coltype`='photo';
delete from `{P}_base_pageset` where `coltype`='member' and `pagename`='photogl';
delete from `{P}_base_pageset` where `coltype`='member' and `pagename`='photofabu';
delete from `{P}_base_pageset` where `coltype`='member' and `pagename`='photomodify';
delete from `{P}_base_pageset` where `coltype`='member' and `pagename`='photocat';

delete from `{P}_base_adminauth` where `coltype`='photo';
delete from `{P}_member_secure` where `coltype`='photo';
delete from `{P}_member_centrule` where `coltype`='photo';

delete from `{P}_comment_cat` where `coltype`='photo';

delete from `{P}_base_plusdefault` where `coltype`='photo';
delete from `{P}_base_plustemp` where `pluslable` regexp 'modPhoto';

delete from `{P}_base_plus` where `coltype`='photo';
delete from `{P}_base_plus` where `plustype`='photo';
delete from `{P}_base_plus` where `plustype`='member' and `pluslocat`='photogl';
delete from `{P}_base_plus` where `plustype`='member' and `pluslocat`='photofabu';
delete from `{P}_base_plus` where `plustype`='member' and `pluslocat`='photomodify';
delete from `{P}_base_plus` where `plustype`='member' and `pluslocat`='photocat';

delete from `{P}_base_plusplan` where `coltype`='photo';
delete from `{P}_base_plusplan` where `plustype`='photo';
delete from `{P}_base_plusplanid` where `plustype`='photo';

DROP TABLE IF EXISTS `{P}_photo_cat`;
DROP TABLE IF EXISTS `{P}_photo_con`;
DROP TABLE IF EXISTS `{P}_photo_config`;
DROP TABLE IF EXISTS `{P}_photo_pages`;
DROP TABLE IF EXISTS `{P}_photo_pcat`;
DROP TABLE IF EXISTS `{P}_photo_proj`;
DROP TABLE IF EXISTS `{P}_photo_prop`;

delete from `{P}_base_coltype` where `coltype`='photo';
