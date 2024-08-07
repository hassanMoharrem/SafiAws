const lang =
    {
        'Safi' :"صافي",
        'Create User' :"إنشاء مستخدم",
        'Click to Add Your Profile Image' :"إضغط لإضافة صورة",
        'Name' :"الإسم",
        'Number System' :"عدد أنظمة التحلية",
        'Email' :"الإيميل",
        'Phone' :"رقم الهاتف",
        'Password' :"كلمة المرور",
        'Action' :"التحكم",
        'Table' :"جدول العرض",
        'Yes , Delete' :"نعم ، حذف",
        'Empty' :"فارغ",
        'Are you sure to delete ?' :"هل أنت متأكد من عملية الحذف ؟",
        'Station' :"أنظمة",
        'Number Phase' :"عدد المراحل",
        'Data is null' :"لا يوجد بيانات",
        'Create dessert Station' :"إنشاء نظام تحلية",
        'Create phase Station' :"إنشاء مرحلة",
        'Delete Dessert' :"حذف النظام",
        'Save changes' :"حفظ التغيرات",
        'Close' :"إغلاق",
        'Are you sure to delete this Dessert ?' :"هل أنت متأكد من عملية الحذف ؟",
        'Edit a user' :"تعديل المستخدم",
        'Delete User' :"حذف المستخدم",
        'Update Phase' :"مراحل النظام",
        'Last Date' :"آخر تاريخ",
        'Next Date' :"التاريخ القادم",
        'Time' :"المدة",
        'Delete Phase' :"حذف المرحلة",
    };

window.__ = function(key, locale)
{
    if (locale === 'ar') {
        return lang[key] || key;
    } else {
        return key;
    }
}

