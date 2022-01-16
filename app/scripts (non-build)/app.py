from PyQt6.QtWidgets import QApplication, QMainWindow, QPushButton, QLineEdit, QVBoxLayout, QLabel, QWidget, QCheckBox, QFileDialog, QProgressBar, QPlainTextEdit
from PyQt6.QtCore import QSize, Qt
import os
import sys
import checking_trello
import configparser


class MainWindow(QMainWindow):
    def __init__(self):
        super(MainWindow, self).__init__()

        config = self.get_config()

        self.source_name = ''

        self.setWindowTitle(config['Customisation']['WindowName'])

        self.first_input_label = QLabel(self.glbfc(config['Customisation']['FirstInputInstruction']))

        self.file_input = QFileDialog()
        self.file_input.setFileMode(QFileDialog.FileMode.ExistingFile)

        self.browse_button_text = self.glbfc(config['Customisation']['FileButtonDefaultText'])
        self.browse_button = QPushButton(self.browse_button_text)
        self.browse_button.clicked.connect(self.get_source_file_name)
        self.browse_button.setMinimumSize(QSize(100, 50))
        self.browse_button.setStyleSheet(config['Customisation']['FileButtonStyle'])

        self.second_input_label = QLabel(self.glbfc(config['Customisation']['SecondInputInstruction']))

        self.input_2 = QLineEdit()

        self.checkbox = QCheckBox()
        self.checkbox.setText(self.glbfc(config['Customisation']['CheckboxText']))

        self.button = QPushButton(self.glbfc(config['Customisation']['ResultButtonText']))
        self.button.clicked.connect(self.create_file)
        self.button.setMinimumSize(QSize(100, 50))
        self.button.setStyleSheet(config['Customisation']['ResultButtonStyle'])

        self.pbar = QProgressBar()

        self.textarea = QPlainTextEdit()
        self.textarea.setMaximumHeight(100)

        self.default_layout = QVBoxLayout()
        self.default_layout.addWidget(self.first_input_label)
        self.default_layout.addWidget(self.browse_button)
        self.default_layout.addWidget(self.second_input_label)
        self.default_layout.addWidget(self.input_2)
        self.default_layout.addWidget(self.checkbox)
        self.default_layout.addWidget(self.button)
        self.default_layout.addWidget(self.textarea)
        self.default_layout.addWidget(self.pbar)

        self.wait_label = QLabel('Ожидайте...\nИдёт анализ...')
        self.wait_label.setAlignment(Qt.AlignmentFlag.AlignHCenter | Qt.AlignmentFlag.AlignVCenter)

        self.finish_label = QLabel(self.glbfc(config['Customisation']['FinishLabel']))
        self.finish_label.setAlignment(Qt.AlignmentFlag.AlignHCenter | Qt.AlignmentFlag.AlignVCenter)

        self.container = QWidget()
        self.container.setLayout(self.default_layout)
        self.setCentralWidget(self.container)

    def get_config(self):
        config = configparser.ConfigParser()
        config.read('config.ini', encoding='utf-8')
        return config

    def glbfc(self, line: str):
        """
        get line breaks from config str
        :param line: str
        :return: str
        """
        return '\n'.join(line.split('\\n'))

    def create_file(self):
        # self.setCentralWidget(self.wait_label)
        # print('wait')

        inp = self.source_name
        out = self.input_2.text()


        checking_trello.create_new_file(inp, out, self.checkbox.checkState() == Qt.CheckState.Checked, self.pbar, self.textarea)
        self.textarea.appendPlainText(f"Файл сохранён, убираю виджеты...")
        # self.setCentralWidget(self.finish_label)
        # print('finish')

    def get_source_file_name(self):
        self.source_name = self.file_input.getOpenFileName()[0]
        self.browse_button.setText(os.path.basename(self.source_name))


app = QApplication(sys.argv)

window = MainWindow()
window.show()

app.exec()
