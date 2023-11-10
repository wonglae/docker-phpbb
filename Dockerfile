FROM selim13/phpbb:3.3.9

LABEL maintainer="tony.w@outlook.com"

### Apache overrides
COPY apache2/httpd.conf /etc/apache2/

### Styles
COPY styles/ /phpbb/www/styles/

### Extensions
COPY ext/ /phpbb/www/ext/

### adsense
COPY ads.txt /phpbb/www/

# WORKDIR /tmp

### CHN language pack
COPY mandarin_chinese_simplified_script_23_2_0/ /phpbb/www/

# RUN curl -SL https://www.phpbb.com/customise/db/download/200001 -o mandarin_chinese_simplified_script_22_12_0.zip \
#     && unzip mandarin_chinese_simplified_script_22_12_0.zip \
#     && cp -r mandarin_chinese_simplified_script_22_12_0/* /phpbb/www \
#     && rm -fR mandarin_chinese_simplified_script_22_12_0

CMD curl -f https://towang-functions.azurewebsites.net/api/update-forum & start.sh

WORKDIR /phpbb/www

EXPOSE 8080