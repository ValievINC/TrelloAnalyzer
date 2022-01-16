import pandas as pd
import requests
import json
from PyQt6.QtWidgets import QProgressBar, QPlainTextEdit


def get_board_id_by_external_link(link):
    board = requests.get(link + '.json')
    id_board = json.loads(board.text)['id']
    return id_board

def get_lists_id_by_border_id(id_board):
    lists = requests.get('https://api.trello.com/1/boards/' + id_board + '/lists?')
    json_lists = json.loads(lists.text)
    id_lists = [list['id'] for list in json_lists]
    return id_lists

def get_tasks_id_by_list_id(id_list):
    tasks = requests.get('https://api.trello.com/1/lists/' + id_list +'/cards?')
    json_tasks = json.loads(tasks.text)
    id_tasks = [task['id'] for task in json_tasks]
    return id_tasks

def get_task_by_id(id_task):
    task = requests.get('https://api.trello.com/1/cards/' + id_task)
    task_json = json.loads(task.text)
    return task_json



# Проверка что карточка 'Любая мелочь' имеет содержимое
def checking_contents_list(id_board):
    id_list = get_lists_id_by_border_id(id_board)
    result = 0
    id_task = []
    for id in id_list:
        if json.loads(requests.get('https://api.trello.com/1/lists/' + id).text)['name'] == 'Любая мелочь':
            id_task = get_tasks_id_by_list_id(id)
            result = 1

    if len(id_task) > 0:
        result = 1
    else:
        result = 0
        # print('У списка "Любая мелочь" нет содержания')

    #return 'Проверка что список "Любая мелочь" имеет содержимое', result
    return result


#Проверка названия списков
def checking_names_lists(id_board):
    standard = ['Планы', 'В процессе', 'Готово', 'Любая мелочь']
    list_names = []
    id_lists = get_lists_id_by_border_id(id_board)
    for id in id_lists:
        list_names.append(json.loads(requests.get('https://api.trello.com/1/lists/' + id).text)['name'])


    result = 0
    for name in standard:
        if name in list_names:
            result += 1
        else:
            result = 0
            # print('Нет карточки с названием "' + name + '"')

    if result == 4:
        result = 1
    else:
        result = 0

    # return 'Проверка названия списков', result
    return result

#Провека списка с тремя карточками к каждой из которых прикреплен хотя бы один человек
# Это может быть любой список кроме "Планы"

def search_and_check_list_with_three_cards(id_board):
    result = 0
    for list_id in get_lists_id_by_border_id(id_board):
        if len(get_tasks_id_by_list_id(list_id)) == 3:
            result = 1
            for task_id in get_tasks_id_by_list_id(list_id):
                if  len(get_task_by_id(task_id)['idMembers']) >= 1:
                    result += 1

    if result == 4:
        result = 1
    elif result != 0:
        result = 0
        # print('Не ко всем карточкам прикрепленны люди')
    else:
        result = 0
        # print('Нет списка с тремя карточками')

    # return 'Проверка столбца с тремя карточками',  result
    return result


# Проверка количества столбцов/списков по критериям в лабе 

def checking_number_lists(id_board):
    lists_number = len(get_lists_id_by_border_id(id_board))
    if lists_number >= 5:
        result = 1
    else:
        # print('Недостаточно столбцов/списков')
        result = 0
    # return 'Проверка количества cписков/столбцов', result
    return result




# Вспомогательная функция для проверки первой карточки
# Проверка чек-листа в первой карточке

def checking_checklist(id_checklist):
    standard = ['Создать доску',
    'Подключить 2 других участников команды',
    'Создать 3 списка',
    'Создать карточку',
    'Установить для карточки срок, участников и добавить обложку',
    'Создать описание с различными шрифтами',
    'Создать ссылку на Google Meet',
    'Написать комментарий',
    'Подключить улучшение',
    'Прикрепить во вложении предыдущую лабораторную с Google диска',
    'Добавить 3 новые карточки',
    'Применить минимум 1 горячую клавишу',
    'Оставить отзыв о лабораторной работе',
    ]

    checklist = requests.get('https://api.trello.com/1/checklists/' + id_checklist)
    checklist_json = json.loads(checklist.text)['checkItems']
    points = [point['name'] for point in checklist_json]
    result = 1
    for point in points:
        if point in standard:
            pass
        else:
            result = 0
    return result


# Вспомогательная функция для проверки первой карточки 
# Провека описания первой карточки 
def checking_card_description(text):
    result = 1
    if 'Заголовок первого уровня' in text and '===' in text:
        pass
    else:
        result = 0
        # print('Неправильный 1 пункт в описание карточки')

    if 'Заголовок второго уровня' in text and '---' in text:
        pass
    else:
        result = 0
        # print('Неправильный 2 пункт в описание карточки')

    if 'Заголовок третьего уровня' in text and '###' in text:
        pass
    else:
        result = 0
        # print('Неправильный 3 пункт в описание карточки')

    if '*Курсив*' in text:
        pass
    else:
        result = 0
        # print('Неправильный 4 пункт в описание карточки')

    if '**Жирный**' in text:
        pass
    else:
        result = 0
        # print('Неправильный 5 пункт в описание карточки')

    if '~~Зачеркнутый~~' in text:
        pass
    else:
        result = 0
        # print('Неправильный 6 пункт в описание карточки')

    if 'Ссылка на Google Meet]' in text:
        pass
    else:
        result = 0
        # print('Неправильный 7 пункт в описание карточки')

    return result



# Проверка первой карточки
def checking_first_list(id_board):
    id_first_list = get_lists_id_by_border_id(id_board)[0]
    list_name = json.loads(requests.get('https://api.trello.com/1/lists/' + id_first_list).text)['name']
    id_task = get_tasks_id_by_list_id(id_first_list)
    task = get_task_by_id(id_task[0])

    result = 0

    if len(id_task) == 1:
        result = 0.1
        id_task = id_task[0]
        name = get_task_by_id(id_task)['name']

        if list_name == 'Планы': #Проверка что карточка находится в нужном столбце/списке
            result += 0.1
        # else:
        #     print('Первый список должен иметь название "Планы"')

        if name == 'Лабораторная работа Trello': # Проверка что карточка правильно названна
            result += 0.1
        # else:
        #     print('Карточка в первом списке должна иметь название "Лабораторная работа Trello"')

        if task['cover']['idUploadedBackground']  != None: #Проверка что столбец/список имеет обложку
            result += 0.1
        # else:
        #     print('Первый список должен содержать обложку')

        if task['cover']['size']  == "full": #Проверка что текст поверх обложки
            result += 0.05
        # else:
        #     print('Текст карточки, первого списка, должен быть поверх обложки')

        if task['due'] != None: # Проверка что в на карточке есть дата
            result += 0.1
        # else:
        #     print('В первом списке должна быть указанна дата')

        if len(task['idMembers']) >= 3: #Проверка что к карточке прикрепленны люди
            result += 0.05
        # else:
        #     print('К карточке первого списка должно быть прикрепленно 3 человека, включая вас')

        if len(task['idChecklists']) == 0:
            pass
        elif checking_checklist(task['idChecklists'][0]) == 1: #Проверка наличия/правильности чек-листа
            result += 0.1
        # else:
        #     print('В карточке перового списка должен быть чеклист/ чеклист частично неправильный')

        if task['badges']['attachments'] != 0: # Проверка наличия прикрепленного файла
            result += 0.1
        # else:
        #     print('К карточке перового списка должен быть прикреплен файл')

        if checking_card_description(task['desc']) == 1: # Проверка описания карточки
            result += 0.1

        if task['badges']['comments'] != 0: # Проверка наличия коментария
            result += 0.1
        # else:
        #     print('На карточке перового списка Нет комментариев')

    # else:
    #     print('В первом списке "Планы" должны быть только одна карточка')
    # return 'проверка первой карточки', result
    return float(result)


def calling_all_functions(id_board):
    if len(get_lists_id_by_border_id(id_board)) == 0:
        return '0%'
        # return 'Доска пустая \n 0%'
    else:
        result = checking_number_lists(id_board) * 10 + checking_names_lists(id_board) * 10 + search_and_check_list_with_three_cards(id_board) * 10 + checking_contents_list(id_board) * 10
        result += checking_first_list(id_board) * 60
        result = str(round(result, 2)) + '%'
        return result


# # ------------------------------------------------------------------------------------
# # В название файла убрала все пробелы

def get_results(source: str, pbar: QProgressBar, tarea: QPlainTextEdit):
    tarea.appendPlainText(f"Считываю {source}...")
    csv_input = pd.read_csv(source, encoding='utf-8')
    tarea.appendPlainText(f"{source} считан")
    csv_input['Result'] = '0%'
    csv_len = len(csv_input['Link'])

    for i in range(csv_len):
        print(i)
        tarea.appendPlainText(f"Получаю проценты {csv_input['Link'][i]}...")
        res = calling_all_functions(get_board_id_by_external_link(csv_input['Link'][i]))
        tarea.appendPlainText(f"Записываю проценты в новый файл...")
        csv_input['Result'][i] = res
        print(csv_input['Link'][i], res)  # Выводит ссылку и процент
        tarea.appendPlainText(f"Обновляю прогрессбар...")
        pbar.setValue((i + 1) * 100 // csv_len)
    return csv_input


def create_new_file(source_name: str, result_name: str, xlsx: bool, pbar: QProgressBar, tarea: QPlainTextEdit):
    tarea.appendPlainText(f"Выбран режим: csv")
    tarea.appendPlainText(f"Получение файла с процентами...")
    results = get_results(source_name, pbar, tarea)
    results.to_csv(result_name + '.csv', index=False)
    tarea.appendPlainText(f"Файл {result_name}.csv сохранён...")
    if xlsx:
        tarea.appendPlainText(f"Создаю xlsx документ...")
        try:
            results.to_excel(result_name + '.xlsx', index=False)
        except Exception as exc:
            tarea.appendPlainText(f"ОШИБКА: {exc}")
        else:
            tarea.appendPlainText(f"Файл {result_name}.xlsx сохранён...")
