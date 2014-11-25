# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Makefile                                           :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: kperreau <kperreau@student.42.fr>          +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2014/11/03 14:06:54 by kperreau          #+#    #+#              #
#    Updated: 2014/11/25 17:10:54 by kperreau         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

NAME = test_gnl

SRCS = get_next_line.c

OFILES = $(SRCS:.c=.o)

FLAGS = -Wall -Wextra -Werror -I libft/includes/ -c

all: $(NAME)

$(NAME):
	@make -C libft/ fclean
	@make -C libft/	
	@gcc $(FLAGS) $(SRCS)
	@gcc $(FLAGS) main.c
	@gcc -o $(NAME) get_next_line.o main.o -L libft/ -lft

clean:
	@rm -f $(OFILES)

fclean: clean
	@rm -f $(NAME)

re: fclean all
