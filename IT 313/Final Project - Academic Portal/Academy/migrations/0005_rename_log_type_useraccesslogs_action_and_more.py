# Generated by Django 5.1.4 on 2025-01-06 04:08

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('Academy', '0004_useraccountlogs_and_more'),
    ]

    operations = [
        migrations.RenameField(
            model_name='useraccesslogs',
            old_name='log_type',
            new_name='action',
        ),
        migrations.RenameField(
            model_name='useraccountlogs',
            old_name='log_type',
            new_name='action',
        ),
    ]
