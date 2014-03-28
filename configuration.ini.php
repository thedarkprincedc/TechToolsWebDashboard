; Configuration Template
; Rename to configuration.ini

[general_settings]
title = "DSS Feeds Dashboard"
background_image = ""
realtime_update_interval = 1000

[nagios_settings]
url = "<nagios url>" 

[prtg_settings]
username = "prtgadmin"
password = "prtgadmin"
url = "<prtg admin url>"

[weather_settings]
url = "http://api.wunderground.com/api/69ca9d7ace9be5b9/conditions/q/NY/Rochester.json"
cam_url = "http://wwc.instacam.com/instacamimg/RCSTM/RCSTM_l.jpg?rnd=15-102120130802&time="
update_interval = 1800000

[news_settings]
url = "http://www.msn.com/rss/msnnews.aspx"
update_interval = 60000

[redmine_settings]
url = "<redmine_url_here>"
api_key = "<api key here>"
update_interval = 1000

[employee_settings]
names = "<names ; delimited>"
email = "<email address>"
gps = false
update_interval = 5000
