# Generated by Django 5.1.4 on 2025-01-06 04:30

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('Academy', '0006_useraccountlogs_action_by'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='useraccountlogs',
            name='action_by',
        ),
    ]
