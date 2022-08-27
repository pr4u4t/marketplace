PURPLE="\[\033[0;35m\]"
RED="\[\033[0;31m\]"
GREEN="\[\033[0;32m\]"
NO_COLOUR="\[\033[0m\]"

if [ "$(id -u)" = "0" ]; then 
WARN=$RED
else
WARN=$GREEN
fi

PS1="$RED\u$NO_COLOUR@$GREEN\h $PURPLE\w $GREEN;$RED]$NO_COLOUR "

alias php=php7
alias lsc="ls -lah --color=auto"
