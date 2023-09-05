FROM selim13/phpbb:3.3.9

LABEL maintainer="tony.w@outlook.com"

WORKDIR /tmp

### CHN language pack for phpbb 3.39
RUN curl -SL https://www.phpbb.com/customise/db/download/200001 -o mandarin_chinese_simplified_script_22_12_0.zip \
    && unzip mandarin_chinese_simplified_script_22_12_0.zip \
    && cp -r mandarin_chinese_simplified_script_22_12_0/* /phpbb/www \
    && rm -fR mandarin_chinese_simplified_script_22_12_0

WORKDIR /phpbb/www
